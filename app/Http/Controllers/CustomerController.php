<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Setting;
use App\Models\Traffic;
use Illuminate\Http\Request;

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
        ]);

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
