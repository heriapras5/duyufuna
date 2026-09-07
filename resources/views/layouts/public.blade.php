<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $siteName = $globalSetting->website_name ?? config('app.name');
        $tagline = $globalSetting->tagline ?? 'Melayani Tamu Allah, Sepenuh Hati';
        $toAbs = fn ($u) => $u ? ((str_starts_with($u, 'http://') || str_starts_with($u, 'https://')) ? $u : url($u)) : null;
        $resolveImg = function ($p) use ($toAbs) {
            if (!$p || !trim((string) $p)) return null;
            $p = trim((string) $p);
            if (str_starts_with($p, 'http://') || str_starts_with($p, 'https://')) return $p;
            if (str_ends_with(strtolower($p), '.svg')) return null;
            return $toAbs(Storage::url($p));
        };

        $ogTitleDefault = $globalSetting->og_title ?: $globalSetting->seo_title ?: $siteName;
        $ogDescDefault = $globalSetting->og_description ?: $globalSetting->seo_description ?: $tagline;

        // Gambar dinamis per-halaman via @section('og_image', $pathStorage); fallback: OG global → logo → favicon.
        $pageOgImage = trim((string) ($__env->yieldContent('og_image') ?? ''));
        $ogImagePath = null;
        $ogImageUrl = $resolveImg($pageOgImage);
        if ($ogImageUrl) {
            $ogImagePath = $pageOgImage;
        } else {
            $ogImagePath = $globalSetting->og_image ?: ($globalSetting->logo ?: $globalSetting->favicon);
            $ogImageUrl = $resolveImg($ogImagePath);
        }
        $twitterImageUrl = $resolveImg($globalSetting->twitter_image) ?: $ogImageUrl;

        // Dimensi asli file (fallback 1200x630) agar deklarasi og:image akurat.
        $ogImageWidth = 1200;
        $ogImageHeight = 630;
        if ($ogImagePath && !str_starts_with($ogImagePath, 'http://') && !str_starts_with($ogImagePath, 'https://')) {
            try {
                $dims = @getimagesize(Storage::disk('public')->path($ogImagePath));
                if (is_array($dims) && $dims[0] > 0 && $dims[1] > 0) {
                    $ogImageWidth = $dims[0];
                    $ogImageHeight = $dims[1];
                }
            } catch (\Throwable $e) {}
        }

        // Override khusus share (dipakai Beranda): section og_title/og_description mengalahkan judul/deskripsi halaman.
        $pageOgTitle = trim((string) ($__env->yieldContent('og_title') ?? ''));
        $pageOgDesc = trim((string) ($__env->yieldContent('og_description') ?? ''));
        $pageTitle = trim((string) ($__env->yieldContent('title') ?? ''));
        $pageMetaDesc = trim((string) ($__env->yieldContent('meta_description') ?? ''));
        $ogTitle = $pageOgTitle ?: ($pageTitle ?: $ogTitleDefault);
        $ogDesc = $pageOgDesc ?: ($pageMetaDesc ?: $ogDescDefault);
    @endphp
    <title>@yield('title', $ogTitleDefault) - {{ $siteName }}</title>
    <meta name="description" content="@yield('meta_description', $globalSetting->seo_description ?: $tagline)">
    <meta name="keywords" content="@yield('seo_keywords', $globalSetting->seo_keywords ?? 'umroh, haji, travel umroh')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:type" content="@yield('og_type', $globalSetting->og_type ?: 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $globalSetting->og_site_name ?: $siteName }}">
    <meta property="og:locale" content="id_ID">
    @if($ogImageUrl)
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta property="og:image:secure_url" content="{{ $ogImageUrl }}">
    <meta property="og:image:width" content="{{ $ogImageWidth }}">
    <meta property="og:image:height" content="{{ $ogImageHeight }}">
    <meta property="og:image:alt" content="{{ $ogTitle }}">
    @endif
    <meta name="twitter:card" content="{{ $globalSetting->twitter_card ?: ($ogImageUrl ? 'summary_large_image' : 'summary') }}">
    <meta name="twitter:title" content="{{ $globalSetting->twitter_title ?: $ogTitle }}">
    <meta name="twitter:description" content="{{ $globalSetting->twitter_description ?: $ogDesc }}">
    @if($twitterImageUrl)
    <meta name="twitter:image" content="{{ $twitterImageUrl }}">
    @endif
    @if($globalSetting->robots)
    <meta name="robots" content="{{ $globalSetting->robots }}">
    @endif
    <link rel="canonical" href="{{ $globalSetting->canonical_url ?: url()->current() }}">
    @if($globalSetting->google_site_verification)
    <meta name="google-site-verification" content="{{ $globalSetting->google_site_verification }}">
    @endif
    @if($globalSetting->bing_site_verification)
    <meta name="msvalidate.01" content="{{ $globalSetting->bing_site_verification }}">
    @endif
    @if($globalSetting->sitemap_enabled)
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">
    @endif
    @if($globalSetting->google_analytics_id)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSetting->google_analytics_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $globalSetting->google_analytics_id }}');
    </script>
    @endif
    @if($globalSetting->google_tag_manager_id)
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $globalSetting->google_tag_manager_id }}');</script>
    @endif
    @if($globalSetting->schema_enabled)
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $globalSetting->org_name ?: $globalSetting->website_name,
        'url' => url('/'),
        'logo' => $globalSetting->org_logo ? Storage::url($globalSetting->org_logo) : null,
        'telephone' => $globalSetting->org_phone,
        'email' => $globalSetting->org_email,
        'address' => $globalSetting->org_address,
        'geo' => ($globalSetting->org_geo_lat && $globalSetting->org_geo_lng)
            ? ['@type' => 'GeoCoordinates', 'latitude' => $globalSetting->org_geo_lat, 'longitude' => $globalSetting->org_geo_lng]
            : null,
    ], fn($v) => !empty($v) && $v !== null), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endif
    @php $iconUrl = ($globalSetting && $globalSetting->favicon)
        ? Storage::url($globalSetting->favicon)
        : (($globalSetting && $globalSetting->logo) ? Storage::url($globalSetting->logo) : asset('favicon.ico')); @endphp
    <link rel="icon" type="image/png" sizes="128x128" href="{{ $iconUrl }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $iconUrl }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $iconUrl }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    @if($globalSetting && $globalSetting->logo)
    <link rel="preload" as="image" href="{{ Storage::url($globalSetting->logo) }}">
    @endif
    @if(!$__env->hasSection('no_hero') && !$__env->hasSection('hero_full') && $headerBanners->count() > 0 && $headerBanners->first()->image)
    <link rel="preload" as="image" href="{{ Storage::url($headerBanners->first()->image) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&family=Playfair+Display:wght@600;700&family=Amiri:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}</style>
    @stack('head')
</head>
<body class="font-sans bg-gradient-to-b from-white via-emerald-50/30 to-white text-gray-900 pb-0 has-fixed-header">
    @if($globalSetting && $globalSetting->google_tag_manager_id)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $globalSetting->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    <header data-scroll-header class="app-header fixed top-0 left-0 right-0 z-40 bg-dark-green transition-all duration-500 gold-border-bottom">
        <div class="flex items-center max-w-7xl mx-auto px-4 md:px-6 lg:px-8 h-14 md:h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                @if($globalSetting && $globalSetting->logo)
                <div class="w-11 h-11 md:w-12 md:h-12 rounded-lg bg-white/10 p-1 flex items-center justify-center shrink-0 transition-colors duration-300 group-hover:bg-white/15">
                    <img src="{{ Storage::url($globalSetting->logo) }}" alt="{{ $globalSetting->website_name ?? 'Logo' }}" width="48" height="48" fetchpriority="high" class="w-full h-full object-contain transition-all duration-300 group-hover:scale-105 group-hover:drop-shadow-[0_0_10px_rgba(245,215,110,0.55)] group-hover:brightness-110">
                </div>
                @else
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gold to-amber-500 flex items-center justify-center shadow-lg shadow-gold/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                        <path d="M12 2v20" stroke="#F5D76E" stroke-width="2.5"/>
                    </svg>
                </div>
                @endif
                <div>
                    <h1 class="text-sm md:text-base font-bold text-white tracking-wide leading-none drop-shadow-sm">{{ $globalSetting->website_name ?? 'DUYUFUNA' }}</h1>
                    <p class="text-[9px] md:text-[11px] font-semibold text-gold-light leading-tight mt-1 tracking-widest uppercase drop-shadow-sm">{{ $globalSetting->tagline ?? 'MELAYANI TAMU ALLAH, SEPENUH HATI' }}</p>
                </div>
            </a>
            <div class="ml-auto flex items-center gap-2 md:gap-3">
            <nav class="hidden md:flex items-center gap-0.5 text-sm font-medium">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg transition-all {{ request()->routeIs('home') ? 'text-gold-light bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Beranda</a>
                <a href="{{ route('pages.tentang') }}" class="px-3 py-2 rounded-lg transition-all {{ request()->routeIs('pages.tentang') ? 'text-gold-light bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Tentang Kami</a>
                <a href="{{ route('articles.index') }}" class="px-3 py-2 rounded-lg transition-all {{ request()->routeIs('articles.*') ? 'text-gold-light bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Artikel</a>
                <a href="{{ route('pages.galeri') }}" class="px-3 py-2 rounded-lg transition-all {{ request()->routeIs('pages.galeri') ? 'text-gold-light bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Galeri Layanan</a>
                <a href="{{ route('pages.testimoni') }}" class="px-3 py-2 rounded-lg transition-all {{ request()->routeIs('pages.testimoni') ? 'text-gold-light bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Testimoni</a>
                <a href="{{ route('pages.faq') }}" class="px-3 py-2 rounded-lg transition-all {{ request()->routeIs('pages.faq') ? 'text-gold-light bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">FAQ</a>
            </nav>
            <div class="flex items-center gap-2">
                <button data-drawer-toggle class="md:hidden w-10 h-10 rounded-xl flex items-center justify-center text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
            </div>
        </div>
    </header>

    <div class="mobile-drawer-overlay"></div>
    <nav class="mobile-drawer">
        <div class="p-6 border-b border-white/10">
            @if($globalSetting && $globalSetting->logo)
            <div class="flex justify-center">
                <div class="w-16 h-16 rounded-xl bg-white/10 p-1 flex items-center justify-center transition-colors duration-300 hover:bg-white/20">
                    <img src="{{ Storage::url($globalSetting->logo) }}" alt="Logo" width="48" height="48" loading="lazy" class="w-full h-full object-contain transition-all duration-300 hover:scale-105 hover:drop-shadow-[0_0_8px_rgba(201,162,39,0.45)] hover:brightness-110">
                </div>
            </div>
            @endif
            <p class="text-[10px] text-gold-light text-center mt-2 font-semibold tracking-widest uppercase">{{ $globalSetting->tagline ?? 'MELAYANI TAMU ALLAH, SEPENUH HATI' }}</p>
        </div>
        <div class="flex-1 p-4 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('home') ? 'bg-white/15 text-gold-light' : 'text-white/75 hover:text-white hover:bg-white/10' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Beranda
            </a>
            <a href="{{ route('pages.tentang') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('pages.tentang') ? 'bg-white/15 text-gold-light' : 'text-white/75 hover:text-white hover:bg-white/10' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Tentang Kami
            </a>
            <a href="{{ route('articles.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('articles.*') ? 'bg-white/15 text-gold-light' : 'text-white/75 hover:text-white hover:bg-white/10' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                Artikel
            </a>
            <a href="{{ route('pages.galeri') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('pages.galeri') ? 'bg-white/15 text-gold-light' : 'text-white/75 hover:text-white hover:bg-white/10' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Galeri Layanan
            </a>
            <a href="{{ route('pages.testimoni') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('pages.testimoni') ? 'bg-white/15 text-gold-light' : 'text-white/75 hover:text-white hover:bg-white/10' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Testimoni
            </a>
            <a href="{{ route('pages.faq') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('pages.faq') ? 'bg-white/15 text-gold-light' : 'text-white/75 hover:text-white hover:bg-white/10' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/><circle cx="12" cy="12" r="10"/></svg>
                FAQ
            </a>
        </div>
        <div class="p-4 border-t border-white/10">
            <p class="text-[10px] text-white/50 text-center">&copy; {{ date('Y') }} {{ $globalSetting->website_name ?? 'DUYUFUNA' }}</p>
        </div>
    </nav>

    {{-- Breadcrumb dihapus sesuai permintaan user (semua halaman public) --}}

    @if(!$__env->hasSection('no_hero'))
    @hasSection('hero_full')
        @yield('hero_full')
    @else
    <div class="relative aspect-[16/9] sm:aspect-auto sm:min-h-[280px] md:min-h-[340px] lg:min-h-[480px] w-full overflow-hidden bg-masjid islamic-pattern gold-border-bottom">
        @hasSection('hero_background')
            @yield('hero_background')
        @else
            <x-banner-slider />
        @endif
        <div class="hero-content-layer absolute inset-0 px-5 md:px-10 lg:px-16 pb-5 md:pb-8 pt-6 flex flex-col justify-end z-30">
            <div class="max-w-7xl mx-auto w-full">
                @yield('hero_content')
            </div>
        </div>
    </div>
    @endif
    @endif

    @hasSection('page_banner')
    <section class="relative h-44 md:h-56 w-full overflow-hidden bg-gradient-to-br from-masjid via-dark-green to-emerald-900">
        <div class="absolute inset-0 masjid-silhouette"></div>
        @yield('page_banner')
        <div class="absolute inset-0 bg-masjid/30"></div>
    </section>
    @endif

    <div class="page-enter">
        @yield('content')
    </div>

<x-footer />
<x-wa-float />
@stack('modals')
</body>
</html>
