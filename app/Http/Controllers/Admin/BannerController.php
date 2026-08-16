<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $banners = Banner::when($search, fn($q) => $q->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%");
            }))
            ->orderBy('sort')->latest()->paginate(25)->withQueryString();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'sort' => 'nullable|integer|min:0|max:9999',
        ]);

        $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'banners', 1920);
        $validated['status'] = true;
        $validated['sort'] ??= Banner::max('sort') + 1;

        Banner::create($validated);

        Cache::forget('headerBanners');

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'sort' => 'nullable|integer|min:0|max:9999',
            'status' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'banners', 1920);
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
        } elseif ($request->input('remove_image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $validated['image'] = null;
        }

        $validated['sort'] ??= Banner::max('sort') + 1;

        $banner->update($validated);

        Cache::forget('headerBanners');

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();

        Cache::forget('headerBanners');

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
