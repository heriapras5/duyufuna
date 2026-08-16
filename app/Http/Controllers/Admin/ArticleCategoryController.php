<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Services\SlugService;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = ArticleCategory::withCount('articles')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('sort')->paginate(25)->withQueryString();
        return view('admin.article_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.article_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['name'], 'article_categories');
        $validated['sort'] ??= ArticleCategory::max('sort') + 1;

        ArticleCategory::create($validated);

        return redirect()->route('admin.article_categories.index')->with('success', 'Kategori artikel berhasil ditambahkan.');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        return view('admin.article_categories.edit', compact('articleCategory'));
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['name'], 'article_categories', $articleCategory->id);
        $validated['sort'] ??= ArticleCategory::max('sort') + 1;

        $articleCategory->update($validated);

        return redirect()->route('admin.article_categories.index')->with('success', 'Kategori artikel berhasil diperbarui.');
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();

        return redirect()->route('admin.article_categories.index')->with('success', 'Kategori artikel berhasil dihapus.');
    }
}
