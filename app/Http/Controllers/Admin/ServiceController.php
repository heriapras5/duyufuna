<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Service;
use App\Services\HtmlNormalizer;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function create(Request $request)
    {
        $category = Category::find($request->query('category_id'));

        if (!$category) {
            return redirect()->route('admin.categories.index')
                ->with('info', 'Pilih kategori terlebih dahulu melalui menu Kategori Layanan.');
        }

        return view('admin.services.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['title'], 'services');
        $validated['status'] = true;
        $validated['description'] = HtmlNormalizer::clean($validated['description'] ?? null);

        if ($request->hasFile('image')) {
            $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'services');
        }

        $service = Service::create($validated);

        return redirect()->route('admin.categories.show', $service->category_id)->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['title'], 'services', $service->id);
        $validated['status'] = $request->boolean('status', $service->status);
        $validated['description'] = HtmlNormalizer::clean($validated['description'] ?? null);

        if ($request->hasFile('image')) {
            $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'services');
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        } elseif ($request->input('remove_image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = null;
        }

        $service->update($validated);

        return redirect()->route('admin.categories.show', $service->category_id)->with('success', 'Layanan berhasil diperbarui.');
    }

    public function edit(Service $service)
    {
        $service->load('serviceItems');
        return view('admin.services.edit', compact('service'));
    }

    public function destroy(Service $service)
    {
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

        return redirect()->route('admin.categories.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
