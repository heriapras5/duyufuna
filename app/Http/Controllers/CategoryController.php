<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $services = $category->services()
            ->where('status', true)
            ->with(['serviceItems' => fn ($q) => $q->where('status', true)->orderBy('sort')])
            ->paginate(12);

        if ($category->slug === 'transportasi') {
            return view('categories.show_transportasis', compact('category', 'services'));
        }

        $formSlugs = ['laundry', 'buggy-car', 'kursi-roda-umroh', 'fotografer', 'penukaran-uang', 'muthawif'];
        if (in_array($category->slug, $formSlugs, true)) {
            $services = $category->services()->where('status', true)->get();
            return view('categories.show_form', compact('category', 'services'));
        }

        $view = $category->isCatalog()
            ? 'categories.show_catalog'
            : 'categories.show';

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
