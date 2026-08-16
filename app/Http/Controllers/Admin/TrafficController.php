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
    protected function filteredQuery(Request $request)
    {
        $query = Traffic::where('is_lead', true)->latest()->with('customer');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
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
        $traffics = $this->filteredQuery($request)->paginate(25)->withQueryString();

        $statuses = ['baru', 'pelanggan', 'dihubungi', 'konversi', 'batal'];
        $devices = ['Desktop', 'Mobile', 'Tablet'];

        return view('admin.traffics.index', compact('traffics', 'statuses', 'devices'));
    }

    public function destroy(Traffic $traffic)
    {
        abort_unless($traffic->is_lead, 404);

        $traffic->delete();

        return redirect()->route('admin.traffics.index')->with('success', 'Data traffic dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $traffics = $this->filteredQuery($request)->get();
        $filename = 'traffic-leads-' . now()->format('Y-m-d-His') . '.xlsx';

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

        $pdf = Pdf::loadView('admin.traffics.export-pdf', [
            'traffics' => $traffics,
            'exportedAt' => now()->format('d M Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('traffic-leads-' . now()->format('Y-m-d-His') . '.pdf');
    }
}
