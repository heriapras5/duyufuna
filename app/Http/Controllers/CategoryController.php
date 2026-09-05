<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ServiceItem;
use App\Models\TransportRoute;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $services = $category->services()
            ->where('status', true)
            ->with(['serviceItems' => fn ($q) => $q->where('status', true)->orderBy('sort')])
            ->paginate(12);

        if ($category->slug === 'visa') {
            $items = ServiceItem::whereHas('service', fn ($q) => $q
                    ->where('category_id', $category->id)
                    ->where('status', true))
                ->where('status', true)
                ->orderBy('sort')
                ->paginate(12);

            return view('categories.show_visa', compact('category', 'items'));
        }

        // Fotografer: form "Pilih Kegiatan" + galeri per kegiatan.
        if ($category->slug === 'fotografer') {
            $services = $category->services()
                ->where('status', true)
                ->with(['serviceItems' => fn ($q) => $q->where('status', true)->orderBy('sort')])
                ->get();

            $items = $services->flatMap(fn ($s) => $s->serviceItems)->sortBy('sort')->values();
            return view('categories.show_fotografer', compact('category', 'services', 'items'));
        }

        // Penukaran Uang: langsung form konsultasi (pilih jenis layanan di dalam form).
        if ($category->slug === 'penukaran-uang') {
            $services = $category->services()
                ->where('status', true)
                ->with(['serviceItems' => fn ($q) => $q->where('status', true)->orderBy('sort')])
                ->get();

            $items = $services->flatMap(fn ($s) => $s->serviceItems)->sortBy('sort')->values();
            return view('categories.show_money_changer', compact('category', 'services', 'items'));
        }

        if ($category->pageType() === 'form') {
            $services = $category->services()
                ->where('status', true)
                ->with(['serviceItems' => fn ($q) => $q->where('status', true)->orderBy('sort')])
                ->get();

            $items = $services->flatMap(fn ($s) => $s->serviceItems);
            return view('categories.show_form', compact('category', 'services', 'items'));
        }

        if ($category->pageType() === 'transport') {
            $services = $category->services()
                ->where('status', true)
                ->get();

            $routes = TransportRoute::with('prices')
                ->orderBy('sort')
                ->get();

            return view('categories.show_transportasis', compact('category', 'services', 'routes'));
        }

        $view = match ($category->pageType()) {
            'catalog' => 'categories.show_catalog',
            default => 'categories.show',
        };

        return view($view, compact('category', 'services'));
    }

    public function showService($categorySlug, $serviceSlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $service = $category->services()
            ->where('slug', $serviceSlug)
            ->where('status', true)
            ->with(['serviceItems' => fn ($q) => $q->where('status', true)->orderBy('sort')])
            ->firstOrFail();

        return view('categories.show_service', compact('category', 'service'));
    }
}
