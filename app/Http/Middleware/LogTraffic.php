<?php

namespace App\Http\Middleware;

use App\Models\ArticleCategory;
use App\Models\Category;
use App\Models\Service;
use App\Models\Traffic;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogTraffic
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$this->shouldLog($request)) {
            return $response;
        }

        try {
            $this->record($request);
        } catch (\Throwable $e) {
            report($e);
        }

        return $response;
    }

    protected function shouldLog(Request $request): bool
    {
        if (!$request->isMethod('GET')) {
            return false;
        }

        if (str_starts_with($request->path(), 'admin')) {
            return false;
        }

        if (str_starts_with($request->path(), 'login') || $request->path() === 'up' || $request->path() === 'sitemap.xml') {
            return false;
        }

        return true;
    }

    protected function record(Request $request): void
    {
        $route = $request->route();

        if (!$route) {
            return;
        }

        $routeName = $route->getName() ?? $request->path();

        $menu = $this->resolveMenu($routeName, $route);
        [$category, $service] = $this->resolveServiceContext($routeName, $route);

        $userAgent = $request->userAgent() ?? '';
        $device = 'Desktop';
        if (preg_match('/Mobile|Android|iPhone|iPod/i', $userAgent)) {
            $device = 'Mobile';
        } elseif (preg_match('/iPad|Tablet/i', $userAgent)) {
            $device = 'Tablet';
        }

        $last = Traffic::where('ip', $request->ip())
            ->where('url', $request->fullUrl())
            ->where('created_at', '>', now()->subSeconds(20))
            ->latest()
            ->first();

        if ($last) {
            return;
        }

        Traffic::create([
            'route_name' => $routeName,
            'menu' => $menu,
            'category' => $category,
            'service' => $service,
            'url' => $request->fullUrl(),
            'referrer' => $request->headers->get('referer'),
            'ip' => $request->ip(),
            'user_agent' => $userAgent,
            'device' => $device,
            'is_lead' => false,
        ]);
    }

    protected function resolveServiceContext(string $routeName, $route): array
    {
        return match ($routeName) {
            'service.detail' => $this->serviceContext($route),
            'category.service' => $this->serviceContext($route, 'service'),
            'category.show' => $this->categoryContext($route),
            default => [null, null],
        };
    }

    protected function serviceContext($route, string $param = 'slug'): array
    {
        $service = Service::where('slug', $route->parameter($param))->with('category')->first();

        if (!$service) {
            return [null, null];
        }

        return [$service->category?->name, $service->title];
    }

    protected function categoryContext($route): array
    {
        $category = Category::where('slug', $route->parameter('slug'))->first();

        return [$category?->name, null];
    }

    protected function resolveMenu(string $routeName, $route): ?string
    {
        return match ($routeName) {
            'home' => 'Beranda',
            'services.index' => 'Layanan',
            'articles.index' => 'Artikel',
            'articles.show' => 'Artikel',
            'articles.category' => $this->articleCategoryName($route),
            'pages.tentang' => 'Tentang Kami',
            'pages.galeri' => 'Galeri',
            'pages.testimoni' => 'Testimoni',
            'pages.faq' => 'FAQ',
            'category.show' => $this->categoryName($route),
            'service.detail' => $this->serviceCategoryName($route),
            'category.service' => $this->serviceCategoryName($route, 'service'),
            default => ucwords(str_replace(['.', '-', '_'], ' ', $routeName)),
        };
    }

    protected function categoryName($route): ?string
    {
        $category = Category::where('slug', $route->parameter('slug'))->first();
        return $category?->name;
    }

    protected function serviceCategoryName($route, string $param = 'slug'): ?string
    {
        $service = Service::where('slug', $route->parameter($param))->with('category')->first();
        return $service?->category?->name;
    }

    protected function articleCategoryName($route): ?string
    {
        $category = ArticleCategory::where('slug', $route->parameter('slug'))->first();
        return $category?->name;
    }
}
