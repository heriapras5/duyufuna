<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Banner;
use App\Models\FAQ;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected array $map = [
        'banners' => Banner::class,
        'services' => Service::class,
        'service_items' => ServiceItem::class,
        'articles' => Article::class,
        'faqs' => FAQ::class,
        'testimonials' => Testimonial::class,
        'article_categories' => ArticleCategory::class,
    ];

    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'resource' => ['required', 'string', 'in:' . implode(',', array_keys($this->map))],
            'id' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $class = $this->map[$validated['resource']];
        $model = $class::findOrFail($validated['id']);
        $model->update(['status' => (bool) $validated['status']]);

        if ($class === Article::class && $model->status && is_null($model->published_at)) {
            $model->update(['published_at' => now()]);
        }

        return response()->json(['success' => true]);
    }
}
