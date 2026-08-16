<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $services = Service::where('status', true)->get();
        $articles = Article::published()->get();

        $content = view('sitemap', compact('categories', 'services', 'articles'))->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
