<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function tentang()
    {
        $setting = Setting::first();

        return view('tentang', compact('setting'));
    }

    public function galeri()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('galeri', compact('galleries'));
    }

    public function testimoni()
    {
        $testimonials = Testimonial::where('status', true)->latest()->paginate(12);

        return view('testimoni', compact('testimonials'));
    }

    public function faq()
    {
        $faqs = FAQ::where('status', true)->orderBy('sort')->get();

        return view('faq', compact('faqs'));
    }
}