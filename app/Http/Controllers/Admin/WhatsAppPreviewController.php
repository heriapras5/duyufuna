<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class WhatsAppPreviewController extends Controller
{
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'template' => 'nullable|string',
            'data' => 'nullable|array',
        ]);

        $data = array_merge([
            'nama' => '',
            'no_hp' => '',
            'kategori' => 'Umroh',
            'layanan' => 'Paket Umroh Reguler',
            'item' => 'Paket Umroh Reguler',
            'website' => config('app.name'),
            'tanggal' => now()->format('d-m-Y H:i'),
        ], $validated['data'] ?? []);

        $preview = app(WhatsAppService::class)->message($validated['template'] ?? '', $data);

        return response()->json(['preview' => $preview]);
    }
}
