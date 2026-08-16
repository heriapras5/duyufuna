<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [App\Http\Controllers\PageController::class, 'tentang'])->name('pages.tentang');
Route::get('/galeri', [App\Http\Controllers\PageController::class, 'galeri'])->name('pages.galeri');
Route::get('/testimoni', [App\Http\Controllers\PageController::class, 'testimoni'])->name('pages.testimoni');
Route::get('/faq', [App\Http\Controllers\PageController::class, 'faq'])->name('pages.faq');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{category}/{service}', [App\Http\Controllers\CategoryController::class, 'showService'])->name('category.service');
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.detail');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/kategori/{slug}', [ArticleController::class, 'category'])->name('articles.category');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/robots.txt', function () {
    $setting = Illuminate\Support\Facades\Cache::remember(
        'setting',
        3600,
        fn () => App\Models\Setting::first()
    );
    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        'Disallow: /login',
    ];
    if ($setting && $setting->sitemap_enabled) {
        $lines[] = 'Sitemap: ' . url('/sitemap.xml');
    }
    return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain']);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard-data', [App\Http\Controllers\Admin\DashboardController::class, 'data'])->name('dashboard.data');

    Route::resource('banners', App\Http\Controllers\Admin\BannerController::class)->except(['show']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->except(['show', 'index']);

    Route::prefix('catalog')->name('catalog.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\CatalogController::class, 'root'])->name('root');
        Route::get('{category}/groups/create', [App\Http\Controllers\Admin\CatalogController::class, 'groupCreate'])->name('groups.create');
        Route::post('{category}/groups', [App\Http\Controllers\Admin\CatalogController::class, 'groupStore'])->name('groups.store');
        Route::get('{category}/groups/{service}/edit', [App\Http\Controllers\Admin\CatalogController::class, 'groupEdit'])->name('groups.edit');
        Route::put('{category}/groups/{service}', [App\Http\Controllers\Admin\CatalogController::class, 'groupUpdate'])->name('groups.update');
        Route::delete('{category}/groups/{service}', [App\Http\Controllers\Admin\CatalogController::class, 'groupDestroy'])->name('groups.destroy');

        Route::get('{category}', [App\Http\Controllers\Admin\CatalogController::class, 'groups'])->name('groups');
        Route::get('{category}/{service}', [App\Http\Controllers\Admin\CatalogController::class, 'items'])->name('items');
        Route::post('{category}/{service}/items', [App\Http\Controllers\Admin\CatalogController::class, 'storeItem'])->name('items.store');
        Route::get('items/{item}/edit', [App\Http\Controllers\Admin\CatalogController::class, 'itemEdit'])->name('items.edit');
        Route::put('items/{item}', [App\Http\Controllers\Admin\CatalogController::class, 'updateItem'])->name('items.update');
        Route::delete('items/{item}', [App\Http\Controllers\Admin\CatalogController::class, 'destroyItem'])->name('items.destroy');
    });
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class)->except(['show']);
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class)->except(['show']);
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class)->except(['show']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show'])->middleware('super_admin');
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class)->except(['show']);
    Route::resource('article_categories', App\Http\Controllers\Admin\ArticleCategoryController::class)->except(['show']);
    Route::resource('notifications', App\Http\Controllers\Admin\NotificationController::class)->except(['create', 'store', 'show']);
    Route::resource('leads', App\Http\Controllers\Admin\CustomerController::class)
        ->parameters(['leads' => 'customer'])
        ->names([
            'index' => 'customers.index',
            'show' => 'customers.show',
            'edit' => 'customers.edit',
            'update' => 'customers.update',
            'destroy' => 'customers.destroy',
        ])
        ->except(['create', 'store']);
    Route::get('leads-export-excel', [App\Http\Controllers\Admin\CustomerController::class, 'exportExcel'])->name('customers.export-excel');
    Route::get('leads-export-pdf', [App\Http\Controllers\Admin\CustomerController::class, 'exportPdf'])->name('customers.export-pdf');
    Route::get('leads-pdf-preview', [App\Http\Controllers\Admin\CustomerController::class, 'pdfPreview'])->name('customers.pdf-preview');
    Route::put('leads/{customer}/status', [App\Http\Controllers\Admin\CustomerController::class, 'updateStatus'])->name('customers.status');
    Route::get('traffics', [App\Http\Controllers\Admin\TrafficController::class, 'index'])->name('traffics.index');
    Route::delete('traffics/{traffic}', [App\Http\Controllers\Admin\TrafficController::class, 'destroy'])->name('traffics.destroy');
    Route::get('traffics-export-excel', [App\Http\Controllers\Admin\TrafficController::class, 'exportExcel'])->name('traffics.export-excel');
    Route::get('traffics-export-pdf', [App\Http\Controllers\Admin\TrafficController::class, 'exportPdf'])->name('traffics.export-pdf');
    Route::get('traffics-pdf-preview', [App\Http\Controllers\Admin\TrafficController::class, 'pdfPreview'])->name('traffics.pdf-preview');
            Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
            Route::put('settings/{setting}', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
            Route::post('whatsapp-preview', [App\Http\Controllers\Admin\WhatsAppPreviewController::class, 'preview'])->name('whatsapp.preview');
            Route::get('seo', [App\Http\Controllers\Admin\SeoSettingController::class, 'index'])->name('seo.index');
            Route::put('seo/{setting}', [App\Http\Controllers\Admin\SeoSettingController::class, 'update'])->name('seo.update');
            Route::post('status/toggle', [App\Http\Controllers\Admin\StatusController::class, 'toggle'])->name('status.toggle');
            Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
            Route::put('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
            Route::get('search', App\Http\Controllers\Admin\SearchController::class)->name('search');
        });
