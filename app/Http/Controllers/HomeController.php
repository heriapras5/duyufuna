<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', true)->orderBy('sort')->get();
        $categories = Category::withCount('services')->orderBy('sort')->get();
        $testimonials = Testimonial::where('status', true)->latest()->get();
        $articles = Article::published()->latest('published_at')->take(4)->get();
        $setting = Setting::first();

        return view('home', compact('banners', 'categories', 'testimonials', 'articles', 'setting'));
    }
}
