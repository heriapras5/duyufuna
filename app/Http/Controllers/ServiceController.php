<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\TransportRoute;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', true)->with('category');
        if ($q = request('q')) {
            $services->where('title', 'like', '%' . $q . '%');
        }
        if ($category = request('category')) {
            $services->where('category_id', $category);
        }
        $services = $services->paginate(12);
        $categories = Category::has('services')->orderBy('sort')->get();

        return view('services.index', compact('services', 'categories'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('status', true)
            ->with('category', 'banners', 'serviceItems')
            ->firstOrFail();
        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->where('status', true)
            ->limit(4)
            ->get();

        $transportRoutes = null;
        if ($service->category?->pageType() === 'transport') {
            $transportRoutes = TransportRoute::with('prices')->orderBy('sort')->get();
        }

        return view('services.detail', compact('service', 'relatedServices', 'transportRoutes'));
    }
}
