<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;

class ItemController extends Controller
{
    public function show($slug)
    {
        $item = ServiceItem::where('slug', $slug)
            ->where('status', true)
            ->with(['service.category'])
            ->firstOrFail();

        $service = $item->service;
        $category = $service?->category;

        abort_unless($category, 404);

        if ($category->isHotel()) {
            return view('detail.show', compact('item', 'service', 'category'));
        }

        if ($category->slug === 'visa') {
            return view('detail.visa-show', compact('item', 'service', 'category'));
        }

        if ($category->slug === 'handling') {
            return view('detail.handling-show', compact('item', 'service', 'category'));
        }

        if ($category->isCatalog() && !$category->isHotel()) {
            return view('detail.product-show', compact('item', 'service', 'category'));
        }

        abort(404);
    }
}
