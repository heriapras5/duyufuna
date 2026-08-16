<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Customer;
use App\Models\FAQ;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $q = $request->get('q');

        if (!$q || strlen(trim($q)) < 1) {
            return redirect()->route('admin.dashboard');
        }

        $services = Service::where('title', 'like', "%{$q}%")->get();
        $articles = Article::where('title', 'like', "%{$q}%")->get();
        $customers = Customer::where('nama', 'like', "%{$q}%")
            ->orWhere('no_hp', 'like', "%{$q}%")
            ->get();
        $headerBanners = Banner::where('title', 'like', "%{$q}%")->get();
        $categories = Category::where('name', 'like', "%{$q}%")->get();
        $faqs = FAQ::where('question', 'like', "%{$q}%")->get();
        $testimonials = Testimonial::where('name', 'like', "%{$q}%")->get();
        $galleries = Gallery::where('title', 'like', "%{$q}%")->get();
        $notifications = Notification::where('title', 'like', "%{$q}%")->get();
        $users = auth()->user()->isSuperAdmin()
            ? User::where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->get()
            : collect();

        $total = $services->count() + $articles->count() + $customers->count()
            + $headerBanners->count() + $categories->count() + $faqs->count()
            + $testimonials->count() + $galleries->count() + $notifications->count()
            + $users->count();

        return view('admin.search', compact(
            'q', 'total',
            'services', 'articles', 'customers', 'headerBanners', 'categories',
            'faqs', 'testimonials', 'galleries', 'notifications', 'users'
        ));
    }
}
