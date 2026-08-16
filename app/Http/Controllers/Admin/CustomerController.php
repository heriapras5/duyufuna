<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerStatusHistory;
use App\Models\Traffic;
use App\Exports\LeadsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    protected function filteredQuery(Request $request)
    {
        $query = Customer::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }

        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        return $query;
    }

    public function index(Request $request)
    {
        $query = $this->filteredQuery($request);

        // Server-side sorting
        $sortable = ['nama', 'no_hp', 'created_at', 'status'];
        $sortBy = in_array($request->input('sort'), $sortable) ? $request->input('sort') : null;
        $sortDir = $request->input('dir') === 'asc' ? 'asc' : 'desc';

        if ($sortBy) {
            $query->reorder($sortBy, $sortDir);
        }

        $customers = $query->paginate(25)->withQueryString();

        $statuses = ['baru', 'pelanggan', 'dihubungi', 'konversi', 'batal'];

        return view('admin.customers.index', compact('customers', 'statuses'));
    }

    public function edit(Customer $customer)
    {
        $statuses = ['baru', 'pelanggan', 'dihubungi', 'konversi', 'batal'];
        return view('admin.customers.edit', compact('customer', 'statuses'));
    }

    public function show(Customer $customer)
    {
        $customer->load('histories.user');

        $whatsapp = app(\App\Services\WhatsAppService::class);
        $setting = \App\Models\Setting::first();
        $website = $setting?->website_name ?? config('app.name');
        $message = "Assalamu'alaikum {$customer->nama},\n"
            . "Terima kasih telah menghubungi {$website} untuk layanan "
            . ($customer->sumber ?: 'kami') . ".\nAda yang bisa kami bantu?";

        $waUrl = $whatsapp->url($customer->no_hp, null, $message);
        $telUrl = 'tel:+' . preg_replace('/[^0-9]/', '', $customer->no_hp);

        return view('admin.customers.show', compact('customer', 'waUrl', 'telUrl'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'nullable|string|in:baru,pelanggan,dihubungi,konversi,batal',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $customer->status;
        $customer->update($validated);

        $this->syncTrafficStatus($customer);

        $catatan = filled(trim((string) ($request->catatan ?? ''))) ? trim($request->catatan) : null;

        if ($oldStatus !== $customer->status || $catatan !== null) {
            $this->logStatus($customer, $customer->status, $catatan);
        }

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data lead berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:baru,pelanggan,dihubungi,konversi,batal',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $customer->status;
        $customer->update(['status' => $validated['status']]);

        $this->syncTrafficStatus($customer);

        $catatan = filled(trim((string) ($validated['catatan'] ?? ''))) ? trim($validated['catatan']) : null;

        if ($oldStatus !== $validated['status'] || $catatan !== null) {
            $this->logStatus($customer, $validated['status'], $catatan);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Status lead diperbarui.');
    }

    private function syncTrafficStatus(Customer $customer): void
    {
        Traffic::where('is_lead', true)
            ->where('no_hp', $customer->no_hp)
            ->update(['status' => $customer->status]);
    }

    private function logStatus(Customer $customer, string $status, ?string $catatan = null): void
    {
        $customer->histories()->create([
            'status' => $status,
            'catatan' => $catatan,
            'user_id' => Auth::id(),
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Lead berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $customers = $this->filteredQuery($request)->get();
        $filename = 'leads-' . now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(new LeadsExport($customers), $filename);
    }

    public function pdfPreview(Request $request)
    {
        $customers = $this->filteredQuery($request)->get();

        return view('admin.customers.pdf-preview', compact('customers'));
    }

    public function exportPdf(Request $request)
    {
        $customers = $this->filteredQuery($request)->get();

        $pdf = Pdf::loadView('admin.customers.export-pdf', [
            'customers' => $customers,
            'exportedAt' => now()->format('d M Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('leads-' . now()->format('Y-m-d-His') . '.pdf');
    }
}