<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\HtmlNormalizer;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $articles = Article::with('category')
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->latest()->paginate(25)->withQueryString();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = ArticleCategory::orderBy('sort')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'article_category_id' => 'nullable|exists:article_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'status' => 'boolean',
            'published_at' => 'nullable|date',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['title'], 'articles');

        $validated['content'] = HtmlNormalizer::clean($validated['content'] ?? null);

        if ($request->hasFile('image')) {
            $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'articles');
        }

        if (!empty($validated['status']) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::orderBy('sort')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'article_category_id' => 'nullable|exists:article_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'status' => 'boolean',
            'published_at' => 'nullable|date',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = app(SlugService::class)->make($validated['title'], 'articles', $article->id);

        $validated['content'] = HtmlNormalizer::clean($validated['content'] ?? null);

        if ($request->hasFile('image')) {
            $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'articles');
            if ($article->image) Storage::disk('public')->delete($article->image);
        } elseif ($request->input('remove_image')) {
            if ($article->image) Storage::disk('public')->delete($article->image);
            $validated['image'] = null;
        }

        if (!empty($validated['status']) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->image) Storage::disk('public')->delete($article->image);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
