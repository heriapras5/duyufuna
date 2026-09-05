<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\HtmlNormalizer;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = Category::withCount('services')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('sort')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort' => 'nullable|integer|min:0',
            'is_catalog' => 'nullable|boolean',
            'page_type' => 'nullable|string|in:cards,catalog,form,transport',
            'group_label' => 'nullable|string|max:255',
            'item_label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'wa_message' => 'nullable|string',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['name'], 'categories');
        $validated['page_type'] = $validated['page_type'] ?? 'cards';
        $validated['is_catalog'] = $validated['page_type'] === 'catalog';
        $validated['description'] = HtmlNormalizer::clean($validated['description'] ?? null);
        $validated['sort'] ??= Category::max('sort') + 1;

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        if ($category->isCatalog()) {
            return redirect()->route('admin.catalog.groups', $category);
        }

        // Muthawif, Laundry, Buggy, Kursi Roda & Fotografer: satu layanan — langsung ke halaman daftar item.
        if (in_array($category->slug, ['muthawif', 'laundry', 'buggy-car', 'kursi-roda-umroh', 'fotografer'])) {
            $services = $category->services()->orderBy('id')->get();
            if ($services->count() === 1) {
                return redirect()->route('admin.services.items', $services->first());
            }
        }

        $services = $category->services()->with('banners')->latest()->paginate(25)->withQueryString();
        return view('admin.categories.show', compact('category', 'services'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort' => 'nullable|integer|min:0',
            'is_catalog' => 'nullable|boolean',
            'page_type' => 'nullable|string|in:cards,catalog,form,transport',
            'group_label' => 'nullable|string|max:255',
            'item_label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'wa_message' => 'nullable|string',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['name'], 'categories', $category->id);
        $validated['page_type'] = $validated['page_type'] ?? $category->pageType();
        $validated['is_catalog'] = $validated['page_type'] === 'catalog';
        $validated['description'] = HtmlNormalizer::clean($validated['description'] ?? null);
        $validated['sort'] ??= Category::max('sort') + 1;

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        foreach ($category->banners as $banner) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->delete();
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}