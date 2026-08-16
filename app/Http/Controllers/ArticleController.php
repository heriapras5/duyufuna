<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()->latest('published_at')->paginate(12);
        $categories = ArticleCategory::where('status', true)->orderBy('sort')->get();
        return view('articles.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();
        $recentArticles = Article::published()->where('id', '!=', $article->id)->latest('published_at')->take(3)->get();
        $categories = ArticleCategory::where('status', true)->orderBy('sort')->get();
        return view('articles.show', compact('article', 'recentArticles', 'categories'));
    }

    public function category($slug)
    {
        $category = ArticleCategory::where('slug', $slug)->where('status', true)->firstOrFail();
        $articles = Article::published()->where('article_category_id', $category->id)
            ->latest('published_at')->paginate(12);
        $categories = ArticleCategory::where('status', true)->orderBy('sort')->get();
        return view('articles.index', compact('articles', 'categories', 'category'));
    }
}
