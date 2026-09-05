<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Setting;
use App\Models\Traffic;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'item_title' => 'nullable|string|max:255',
            'item_id' => 'nullable|exists:service_items,id',
            // Data harga & konteks dinamis (dikirim dari semua form konsultasi)
            'qty' => 'nullable|integer|min:1|max:1000',
            'unit_price' => 'nullable|numeric|min:0',
            'unit_label' => 'nullable|string|max:40',
            'currency' => 'nullable|string|max:8',
            'pickup' => 'nullable|string|max:255',
            'dropoff' => 'nullable|string|max:255',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|date_format:H:i',
            'pax' => 'nullable|integer|min:1|max:1000',
            'extra_note' => 'nullable|string|max:500',
        ]);

        // Form kegiatan (mis. Fotografer): tanggal kegiatan wajib diisi.
        if (($validated['unit_label'] ?? null) === 'kegiatan' && empty($validated['pickup_date'])) {
            throw ValidationException::withMessages([
                'pickup_date' => 'Tanggal kegiatan wajib diisi.',
            ]);
        }

        $service = isset($validated['service_id']) ? Service::with('category')->find($validated['service_id']) : null;
        $category = $service?->category;
        if (!$category && isset($validated['category_id'])) {
            $category = Category::find($validated['category_id']);
        }
        abort_if(!$category, 422);

        $item = isset($validated['item_id']) ? ServiceItem::find($validated['item_id']) : null;
        if ($item && (!$service || $item->service_id !== $service->id)) {
            $item = null;
        }

        $exists = Customer::where('no_hp', $validated['no_hp'])->exists();

        if ($exists) {
            Customer::where('no_hp', $validated['no_hp'])->update([
                'sumber' => $category->name,
                'layanan' => $service?->title,
                'item' => $item?->title,
            ]);
            Customer::where('no_hp', $validated['no_hp'])->increment('counts');
        } else {
            Customer::create([
                'nama' => $validated['nama'],
                'no_hp' => $validated['no_hp'],
                'sumber' => $category->name,
                'layanan' => $service?->title,
                'item' => $item?->title,
            ])->histories()->create([
                'status' => 'baru',
            ]);
        }

        Traffic::create([
            'route_name' => 'customer.store',
            'menu' => $category->name,
            'category' => $category->name,
            'service' => $service?->title,
            'item' => $item?->title ?? null,
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'status' => 'baru',
            'url' => $request->fullUrl(),
            'referrer' => $request->headers->get('referer'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent() ?? '',
            'device' => $this->detectDevice($request->userAgent() ?? ''),
            'is_lead' => true,
        ]);

        $setting = Setting::first();

        $whatsapp = app(\App\Services\WhatsAppService::class);
        $template = $item?->wa_message ?: $service?->wa_message ?: $category?->wa_message ?: $setting?->wa_message;
        $number = $item?->whatsapp ?: $service?->whatsapp ?: $category?->whatsapp ?: $setting?->whatsapp;
        $itemTitle = trim((string) ($validated['item_title'] ?? '')) ?: ($item?->title ?? '');

        $message = $whatsapp->message($template, [
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'kategori' => $category->name,
            'layanan' => $service?->title ?? $category->name,
            'website' => $setting?->website_name ?? config('app.name'),
            'item' => $itemTitle,
            'tanggal' => now()->format('d-m-Y H:i'),
        ]);

        // Rincian harga & konteks (otomatis & dinamis dari semua form konsultasi).
        // Hanya baris yang benar-benar tersedia di halaman yang disisipkan.
        $detailLines = [];
        $pickup = trim((string) ($validated['pickup'] ?? ''));
        $dropoff = trim((string) ($validated['dropoff'] ?? ''));
        $pickupDate = trim((string) ($validated['pickup_date'] ?? ''));
        $pickupTime = trim((string) ($validated['pickup_time'] ?? ''));
        $qty = isset($validated['qty']) && $validated['qty'] !== null ? (int) $validated['qty'] : null;
        $pax = isset($validated['pax']) && $validated['pax'] !== null ? (int) $validated['pax'] : null;
        $unitPrice = isset($validated['unit_price']) && $validated['unit_price'] !== '' ? (float) $validated['unit_price'] : null;
        $currency = trim((string) ($validated['currency'] ?? '')) ?: 'SAR';
        $unitLabel = trim((string) ($validated['unit_label'] ?? ''));
        $extraNote = trim((string) ($validated['extra_note'] ?? ''));

        if ($pickup !== '' && $dropoff !== '') {
            $detailLines[] = 'Rute: ' . $pickup . ' → ' . $dropoff;
        }
        if ($pickupDate !== '') {
            // Label tanggal mengikuti konteks form: laundry = tanggal laundry, fotografer = kegiatan, lainnya = penjemputan.
            $dateLabel = match (true) {
                $unitLabel === 'kegiatan' => 'Tanggal Kegiatan',
                ($category->slug ?? '') === 'laundry' => 'Tanggal Laundry',
                default => 'Tanggal Penjemputan',
            };
            try {
                $detailLines[] = $dateLabel . ': ' . \Illuminate\Support\Carbon::parse($pickupDate)->format('d-m-Y');
            } catch (\Throwable) {
                $detailLines[] = $dateLabel . ': ' . $pickupDate;
            }
        }
        if ($pickupTime !== '') {
            $detailLines[] = 'Jam: ' . $pickupTime;
        }

        $unitCount = $pax ?? $qty;
        if ($unitPrice !== null && $unitPrice > 0) {
            $fmt = fn ($n) => $currency . ' ' . number_format($n, $currency === 'US$' ? 2 : 0, ',', '.');
            $detailLines[] = 'Harga per ' . ($unitLabel !== '' ? $unitLabel : 'unit') . ': ' . $fmt($unitPrice);
            if ($unitCount !== null && $unitCount > 1) {
                $detailLines[] = 'Jumlah ' . ($unitLabel !== '' ? $unitLabel : 'unit') . ': ' . $unitCount;
            }
            $detailLines[] = 'Total: ' . $fmt($unitPrice * ($unitCount ?? 1));
        } elseif ($unitCount !== null && $unitCount > 1) {
            $detailLines[] = 'Jumlah ' . ($unitLabel !== '' ? $unitLabel : 'unit') . ': ' . $unitCount;
        }

        if ($extraNote !== '') {
            $detailLines[] = 'Catatan: ' . $extraNote;
        }

        if ($detailLines) {
            $message .= "\n\n" . implode("\n", $detailLines);
        }

        $waUrl = $whatsapp->url($number, $setting?->whatsapp, $message);

        if ($exists) {
            $waUrl .= '&existing=1';
        }

        if ($request->expectsJson()) {
            return response()->json(['redirect_url' => $waUrl]);
        }

        return redirect()->away($waUrl);
    }

    protected function detectDevice(string $userAgent): string
    {
        if (preg_match('/iPad|Tablet/i', $userAgent)) {
            return 'Tablet';
        }

        if (preg_match('/Mobile|Android|iPhone|iPod/i', $userAgent)) {
            return 'Mobile';
        }

        return 'Desktop';
    }
}
