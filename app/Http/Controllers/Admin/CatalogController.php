<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Services\HtmlNormalizer;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function root()
    {
        $category = Category::orderBy('sort')->first();

        if ($category) {
            return redirect()->route('admin.catalog.groups', $category);
        }

        return redirect()->route('admin.categories.index');
    }

    public function groups(Category $category)
    {
        abort_unless($category->isCatalog(), 404);

        $services = $category->services()
            ->withCount('serviceItems')
            ->orderBy('title')
            ->get();

        return view('admin.categories.show_catalog', compact('category', 'services'));
    }

    public function groupCreate(Category $category)
    {
        abort_unless($category->isCatalog(), 404);

        $service = new Service(['category_id' => $category->id]);

        return view('admin.catalog.groups_form', compact('category', 'service'));
    }

    public function groupStore(Request $request, Category $category)
    {
        abort_unless($category->isCatalog(), 404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'category_id' => $category->id,
            'title' => $validated['title'],
            'short_description' => trim((string) ($validated['short_description'] ?? '')) ?: null,
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'slug' => app(SlugService::class)->make($validated['title'], 'services'),
            'status' => $request->boolean('status', true),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'services');
        }

        Service::create($data);

        return redirect()
            ->route('admin.catalog.groups', $category)
            ->with('success', $category->groupLabel() . ' berhasil ditambahkan.');
    }

    public function groupEdit(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        return view('admin.catalog.groups_form', compact('category', 'service'));
    }

    public function groupUpdate(Request $request, Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'short_description' => trim((string) ($validated['short_description'] ?? '')) ?: null,
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'slug' => app(SlugService::class)->make($validated['title'], 'services', $service->id),
            'status' => $request->boolean('status', $service->status),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'services');
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        } elseif ($request->input('remove_image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = null;
        }

        $service->update($data);

        return redirect()
            ->route('admin.catalog.groups', $category)
            ->with('success', $category->groupLabel() . ' berhasil diperbarui.');
    }

    public function groupDestroy(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        foreach ($service->banners as $banner) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->delete();
        }
        foreach ($service->serviceItems as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
        }
        $service->delete();

        return redirect()
            ->route('admin.catalog.groups', $category)
            ->with('success', $category->groupLabel() . ' berhasil dihapus.');
    }

    public function items(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $service->load('serviceItems');

        return view('admin.catalog.items', compact('category', 'service'));
    }

    public function itemEdit(ServiceItem $item)
    {
        $service = $item->service;
        $category = $service->category;

        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        return view('admin.catalog.items_form', compact('category', 'service', 'item'));
    }

    public function storeItem(Request $request, Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'sort' => $service->serviceItems()->max('sort') + 1,
            'status' => true,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'service-items', 1200);
        }

        $service->serviceItems()->create($data);

        return redirect()
            ->route('admin.catalog.items', [$category, $service])
            ->with('success', $category->itemLabel() . ' berhasil ditambahkan.');
    }

    public function updateItem(Request $request, ServiceItem $item)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'status' => $request->has('status') ? (bool) $request->input('status') : $item->status,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'service-items', 1200);
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
        } elseif ($request->input('remove_image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = null;
        }

        $item->update($data);

        return redirect()
            ->route('admin.catalog.items', [$item->service->category_id, $item->service_id])
            ->with('success', 'Item berhasil diperbarui.');
    }

    public function destroyItem(ServiceItem $item)
    {
        $service = $item->service;
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return redirect()
            ->route('admin.catalog.items', [$service->category_id, $service->id])
            ->with('success', 'Item berhasil dihapus.');
    }
}