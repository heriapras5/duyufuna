<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TrafficExport;
use App\Http\Controllers\Controller;
use App\Models\Traffic;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrafficController extends Controller
{
    protected function type(Request $request): string
    {
        return $request->input('type', 'kunjungan') === 'leads' ? 'leads' : 'kunjungan';
    }

    protected function typeIsLead(Request $request): bool
    {
        return $this->type($request) === 'leads';
    }

    protected function filteredQuery(Request $request)
    {
        $isLead = $this->typeIsLead($request);

        $query = Traffic::where('is_lead', $isLead)->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search, $isLead) {
                if ($isLead) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%");
                }
                $q->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%")
                  ->orWhere('menu', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%");
            });
        }

        if ($isLead && $request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('device')) {
            $query->where('device', $request->device);
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
        $perPage = in_array((int) $request->input('per_page', 25), [25, 50, 100, 200], true)
            ? (int) $request->input('per_page')
            : 25;

        $traffics = $this->filteredQuery($request)->paginate($perPage)->withQueryString();

        $statuses = ['baru', 'pelanggan', 'dihubungi', 'konversi', 'batal'];
        $devices = ['Desktop', 'Mobile', 'Tablet'];
        $type = $this->type($request);

        return view('admin.traffics.index', compact('traffics', 'statuses', 'devices', 'type'));
    }

    public function destroy(Traffic $traffic)
    {
        $traffic->delete();

        return redirect()->route('admin.traffics.index', ['type' => $this->type(request())])
            ->with('success', 'Data traffic dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $traffics = $this->filteredQuery($request)->get();
        $type = $this->typeIsLead($request) ? 'leads' : 'kunjungan';
        $filename = 'traffic-' . $type . '-' . now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(new TrafficExport($traffics), $filename);
    }

    public function pdfPreview(Request $request)
    {
        $traffics = $this->filteredQuery($request)->get();

        return view('admin.traffics.pdf-preview', compact('traffics'));
    }

    public function exportPdf(Request $request)
    {
        $traffics = $this->filteredQuery($request)->get();

        $type = $this->typeIsLead($request) ? 'leads' : 'kunjungan';

        $pdf = Pdf::loadView('admin.traffics.export-pdf', [
            'traffics' => $traffics,
            'exportedAt' => now()->format('d M Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('traffic-' . $type . '-' . now()->format('Y-m-d-His') . '.pdf');
    }
}