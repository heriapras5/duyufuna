<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $setting = cache()->remember('setting', 3600, fn() => Setting::first()) ?? new Setting;
            $view->with('globalSetting', $setting);

            $headerBanners = cache()->remember('headerBanners', 3600, fn() => Banner::where('status', true)
                ->whereNull('category_id')
                ->whereNull('service_id')
                ->orderBy('sort')
                ->get());
            $view->with('headerBanners', $headerBanners);
        });
    }
}
