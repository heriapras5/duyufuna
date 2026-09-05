<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportPrice;
use App\Models\TransportRoute;
use Illuminate\Http\Request;

class TransportRouteController extends Controller
{
    public function index()
    {
        $routes = TransportRoute::with('prices')
            ->orderBy('sort')
            ->orderBy('code')
            ->get();

        $vehicles = \App\Models\Service::whereHas('category', fn($q) => $q->where('page_type', 'transport'))
            ->where('status', true)
            ->pluck('title')
            ->values()
            ->all();

        return view('admin.transport_routes.index', compact('routes', 'vehicles'));
    }

    public function create()
    {
        $vehicles = \App\Models\Service::whereHas('category', fn($q) => $q->where('page_type', 'transport'))
            ->where('status', true)
            ->pluck('title')
            ->values()
            ->all();

        return view('admin.transport_routes.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'name_ar' => 'nullable|string|max:255',
            'pickup_label' => 'required|string|max:255',
            'dropoff_label' => 'required|string|max:255',
            'sort' => 'nullable|integer|min:0',
            'prices' => 'nullable|array',
            'prices.*' => 'nullable|numeric|min:0',
        ]);

        $validated['sort'] ??= TransportRoute::max('sort') + 1;

        $route = TransportRoute::create([
            'code' => $validated['code'],
            'name_ar' => $validated['name_ar'] ?? null,
            'pickup_label' => $validated['pickup_label'],
            'dropoff_label' => $validated['dropoff_label'],
            'sort' => $validated['sort'],
        ]);

        if (!empty($validated['prices'])) {
            foreach ($validated['prices'] as $vehicle => $price) {
                if ($price !== null && $price !== '') {
                    TransportPrice::create([
                        'route_id' => $route->id,
                        'vehicle' => $vehicle,
                        'price' => $price,
                    ]);
                }
            }
        }

        return redirect()->route('admin.transport-routes.index')
            ->with('success', 'Rute transportasi berhasil ditambahkan.');
    }

    public function edit(TransportRoute $transportRoute)
    {
        $transportRoute->load('prices');

        $vehicles = \App\Models\Service::whereHas('category', fn($q) => $q->where('page_type', 'transport'))
            ->where('status', true)
            ->pluck('title')
            ->values()
            ->all();

        $priceMap = $transportRoute->prices->mapWithKeys(fn($p) => [$p->vehicle => $p->price])->all();

        return view('admin.transport_routes.edit', compact('transportRoute', 'vehicles', 'priceMap'));
    }

    public function update(Request $request, TransportRoute $transportRoute)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'name_ar' => 'nullable|string|max:255',
            'pickup_label' => 'required|string|max:255',
            'dropoff_label' => 'required|string|max:255',
            'sort' => 'nullable|integer|min:0',
            'prices' => 'nullable|array',
            'prices.*' => 'nullable|numeric|min:0',
        ]);

        $transportRoute->update([
            'code' => $validated['code'],
            'name_ar' => $validated['name_ar'] ?? $transportRoute->name_ar,
            'pickup_label' => $validated['pickup_label'],
            'dropoff_label' => $validated['dropoff_label'],
            'sort' => $validated['sort'] ?? $transportRoute->sort,
        ]);

        // Sync prices
        $transportRoute->prices()->delete();

        if (!empty($validated['prices'])) {
            foreach ($validated['prices'] as $vehicle => $price) {
                if ($price !== null && $price !== '') {
                    TransportPrice::create([
                        'route_id' => $transportRoute->id,
                        'vehicle' => $vehicle,
                        'price' => $price,
                    ]);
                }
            }
        }

        return redirect()->route('admin.transport-routes.index')
            ->with('success', 'Rute transportasi berhasil diperbarui.');
    }

    public function destroy(TransportRoute $transportRoute)
    {
        $transportRoute->prices()->delete();
        $transportRoute->delete();

        return redirect()->route('admin.transport-routes.index')
            ->with('success', 'Rute transportasi berhasil dihapus.');
    }
}