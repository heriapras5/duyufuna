@extends('layouts.public')

@section('title', 'Beranda')
@section('meta_description', $setting->seo_description ?? 'Platform Layanan Umroh Terlengkap - Hotel, Visa, Transportasi, Handling Bandara, Catering, dan lainnya.')
@section('og_title', $setting?->og_title ?: $setting?->website_name ?? 'DUYUFUNA')
@section('og_description', $setting?->og_description ?: trim(($setting?->tagline ?? 'Melayani Tamu Allah, Sepenuh Hati') . '. ' . ($setting?->seo_description ?: 'Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.')))

@section('content')
    {{-- Welcome Card (3D Parallax Tilt) --}}
    <div class="px-4 md:px-6 lg:px-8 max-w-7xl mx-auto mt-3 md:mt-6 relative z-20 scroll-reveal parallax-3d-wrap">
        <div class="card-glass-gold rounded-2xl md:rounded-3xl p-5 md:p-8 overflow-hidden relative parallax-3d" data-parallax-3d>
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-gold/40 via-gold-light to-gold/40"></div>
            <div class="absolute top-0 left-0 w-32 h-32 bg-gold/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-dark-green/5 rounded-full blur-3xl"></div>
            <div class="flex flex-row items-center gap-4 md:gap-8 relative z-10">
                <div class="flex-1 text-left parallax-3d-layer">
                    @php
                        $greetTitle = trim((string) ($setting->greeting_title ?? ''));
                        $greetSubtitle = trim((string) ($setting->greeting_subtitle ?? ''));
                        $greetText = trim((string) ($setting->greeting_text ?? ''));
                        $greetBrandName = $setting->website_name ?? '';
                        $highlight = $greetBrandName !== ''
                            ? fn ($t) => preg_replace('/' . preg_quote($greetBrandName, '/') . '/iu', '<span class="font-semibold text-dark-green">$0</span>', e($t))
                            : fn ($t) => e($t);
                    @endphp
                    @if($greetTitle)
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 font-serif leading-snug">{{ $greetTitle }}</h3>
                    @endif
                    @if($greetSubtitle)
                    <p class="text-sm md:text-base text-gray-400 mt-1.5 leading-relaxed">{!! $highlight($greetSubtitle) !!}</p>
                    @endif
                    @if($greetText)
                    <p class="text-xs sm:text-sm md:text-base text-gray-500 mt-2 leading-relaxed">{!! $highlight($greetText) !!}</p>
                    @endif
                </div>
                @if($setting && $setting->greeting_image)
                <div class="w-28 h-28 md:w-36 md:h-36 shrink-0 relative parallax-3d-pop">
                    <div class="w-full h-full relative welcome-img-3d">
                        <div class="welcome-halo absolute inset-0 bg-gradient-to-br from-gold/50 to-amber-500/50 rounded-full blur-2xl"></div>
                        <div class="absolute inset-3 bg-white/60 rounded-2xl md:rounded-3xl shadow-[0_10px_30px_rgba(201,162,39,0.35)] ring-1 ring-gold/40 overflow-hidden">
                            <div class="glare"></div>
                            <img src="{{ Storage::url($setting->greeting_image) }}" alt="{{ $setting->website_name ?? '' }}" fetchpriority="high" width="128" height="128" class="w-full h-full object-contain drop-shadow-lg">
                        </div>
                    </div>
                </div>
                @else
                <div class="w-28 h-28 md:w-36 md:h-36 shrink-0 relative parallax-3d-pop">
                    <div class="absolute inset-0 bg-gradient-to-br from-gold/30 via-amber-500/30 to-dark-green/10 rounded-2xl blur-xl"></div>
                    <div class="relative w-full h-full rounded-2xl bg-gradient-to-br from-gold/10 via-amber-500/10 to-dark-green/10 flex items-center justify-center shadow-inner ring-1 ring-gold/30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="opacity-60">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                            <path d="M12 2v20" stroke="#C9A227" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-section-divider />

    {{-- Category Grid --}}
    @if($categories->count() > 0)
    @php
        $svgs = [
            'hotel' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M3 21V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14"/><path d="M7 21v-4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4"/><path d="M7 3v2"/><path d="M17 3v2"/><rect x="10" y="8" width="4" height="4"/></svg>',
            'visa' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M2 7.5V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5"/><path d="M2 16.5V19a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5"/><path d="M2 12h20"/><rect x="6" y="9" width="4" height="6" rx="1"/><circle cx="17" cy="12" r="2"/></svg>',
            'transportasi' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><rect x="1" y="6" width="18" height="10" rx="2"/><rect x="5" y="10" width="10" height="4" rx="1"/><rect x="16" y="6" width="6" height="8" rx="1"/><circle cx="6" cy="16" r="2"/><circle cx="18" cy="16" r="2"/><path d="M22 12h-3"/></svg>',
            'handling' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M17 14h3l-5-8-3 1V3c0-.55-.45-1-1-1s-1 .45-1 1v4l-3-1-5 8h3l4-2v3l-2 2v3l2-1v2l1 1h2l1-1v-2l2 1v-3l-2-2v-3l4 2z"/></svg>',
            'catering' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M6 2v6a6 6 0 0 0 10 4.46"/><path d="M18 2v6a6 6 0 0 1-6 6"/><path d="M10 14v8"/><path d="M14 14v8"/><path d="M12 2v8"/></svg>',
            'laundry' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M7 2h10l1.5 4H5.5L7 2z"/><path d="M5 6v13a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V6"/><path d="M9 13a3 3 0 0 0 6 0"/><path d="M9 10v3"/><path d="M15 10v3"/></svg>',
            'buggy-car' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/><path d="M5 17h2"/><path d="M17 17h2"/><path d="M2 12h2l3-4h10l3 4h2"/><path d="M9 8h6"/><path d="M3 14h18"/></svg>',
            'jastip-viral' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/><path d="M9 6v6c0 .55.45 1 1 1h4c.55 0 1-.45 1-1V6"/></svg>',
            'kursi-roda-umroh' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><circle cx="7" cy="18" r="3"/><circle cx="17" cy="18" r="3"/><path d="M9 18h8"/><path d="M17 18V9a2 2 0 0 0-2-2H9"/><path d="M14 3h4l-1 4"/><path d="M6 10h3"/></svg>',
            'fotografer' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/><path d="M12 9v4l2 2"/></svg>',
            'penukaran-uang' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><circle cx="12" cy="12" r="10"/><path d="M12 6v12"/><path d="M16 8.5C16 7.12 14.21 6 12 6s-4 1.12-4 2.5c0 1.38 1.79 2.5 4 2.5s4 1.12 4 2.5c0 1.38-1.79 2.5-4 2.5s-4-1.12-4-2.5"/></svg>',
            'muthawif' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-sm"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
        ];
    @endphp
    <section class="px-4 md:px-6 lg:px-8 pt-4 pb-6 md:pt-6 md:pb-10 max-w-7xl mx-auto">
        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4 lg:gap-5 stagger-children scroll-reveal">
            @foreach($categories as $i => $category)
            <a href="{{ url('/category/' . $category->slug) }}"
               class="home-service-card parallax-3d-card card-glass-gold group p-2 sm:p-3 md:p-4 flex flex-col items-center text-center gap-2 md:gap-3 min-h-[100px] sm:min-h-[110px] md:min-h-[130px] justify-center"
               style="transition-delay: {{ $i * 0.04 }}s;">
                <div class="w-12 h-12 md:w-12 md:h-12 rounded-2xl flex items-center justify-center text-dark-green transition-all duration-500 category-icon ring-1 ring-white/40 parallax-3d-icon"
                     style="background: {{ match($i % 8) {
                        0 => 'linear-gradient(135deg, #E8F8F1, #a7f3d0)',
                        1 => 'linear-gradient(135deg, #FDF8F0, #fef3c7)',
                        2 => 'linear-gradient(135deg, #fef3c7, #fde68a)',
                        3 => 'linear-gradient(135deg, #FDF2F0, #fecaca)',
                        4 => 'linear-gradient(135deg, #F8F0FF, #e9d5ff)',
                        5 => 'linear-gradient(135deg, #F0F8FF, #bae6fd)',
                        6 => 'linear-gradient(135deg, #F0FDF4, #bbf7d0)',
                        7 => 'linear-gradient(135deg, #FFF7ED, #fed7aa)',
                        default => 'linear-gradient(135deg, #E8F8F1, #a7f3d0)'
                    } }};">
                    @if($category->icon)
                    <span class="text-2xl md:text-2xl category-glyph group-hover:scale-110 transition-transform duration-300">{{ $category->icon }}</span>
                    @else
                    {!! $svgs[$category->slug] ?? '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform duration-300"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>' !!}
                    @endif
                </div>
                <div class="flex-1 flex flex-col justify-center w-full px-1">
                    <h3 class="text-[11px] md:text-base font-bold text-gray-900 leading-tight tracking-tight whitespace-nowrap overflow-hidden text-ellipsis">{{ $category->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    <x-section-divider />
    @endif

    {{-- Keunggulan Section (3D Parallax Depth) --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-masjid via-dark-green to-emerald-900 py-14 md:py-20 islamic-pattern scroll-reveal parallax-3d-section">
        <div class="pointer-events-none absolute -top-24 -left-24 w-72 h-72 rounded-full bg-gold/10 blur-3xl parallax-3d-orb" data-parallax-depth="0.35"></div>
        <div class="pointer-events-none absolute -bottom-32 -right-20 w-96 h-96 rounded-full bg-emerald-400/10 blur-3xl parallax-3d-orb" data-parallax-depth="0.2"></div>
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 relative">
            <div class="text-center mb-10 md:mb-14">
                <span class="section-label section-label-gold">{{ $setting->why_label ?? 'Mengapa Kami' }}</span>
                <h2 class="font-serif text-2xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">{!! $setting->why_title ?? 'Kenapa Memilih <span class="text-gradient-gold">DUYUFUNA</span>?' !!}</h2>
                <p class="text-white/50 text-sm md:text-base mt-3 max-w-lg mx-auto">{{ $setting->why_subtitle ?? 'Kami berkomitmen memberikan layanan terbaik untuk perjalanan umroh Anda' }}</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 stagger-children scroll-reveal">
                {{-- Kartu 1: Layanan Lengkap --}}
                <div class="parallax-3d-tile group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-3.5 md:p-6 text-center hover:bg-white/[0.08] hover:border-gold/30 transition-all duration-500">
                    <div class="w-11 h-11 md:w-14 md:h-14 mx-auto rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/30 mb-2.5 md:mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/><path d="M12 2v20" stroke="#C9A227" stroke-width="2.5"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-[13px] md:text-base mb-1 md:mb-2">Layanan Lengkap</h3>
                    <p class="text-white/60 text-[11px] md:text-sm leading-relaxed">Visa, hotel, transportasi, handling, catering, dan kebutuhan umroh lainnya dalam satu platform.</p>
                </div>
                {{-- Kartu 2: Tim Profesional --}}
                <div class="parallax-3d-tile group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-3.5 md:p-6 text-center hover:bg-white/[0.08] hover:border-gold/30 transition-all duration-500">
                    <div class="w-11 h-11 md:w-14 md:h-14 mx-auto rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/30 mb-2.5 md:mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-[13px] md:text-base mb-1 md:mb-2">Tim Profesional</h3>
                    <p class="text-white/60 text-[11px] md:text-sm leading-relaxed">Berpengalaman dalam melayani jamaah umroh dan haji dengan amanah dan sepenuh hati.</p>
                </div>
                {{-- Kartu 3: Harga Terbaik --}}
                <div class="parallax-3d-tile group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-3.5 md:p-6 text-center hover:bg-white/[0.08] hover:border-gold/30 transition-all duration-500">
                    <div class="w-11 h-11 md:w-14 md:h-14 mx-auto rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/30 mb-2.5 md:mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-[13px] md:text-base mb-1 md:mb-2">Harga Terbaik</h3>
                    <p class="text-white/60 text-[11px] md:text-sm leading-relaxed">Biaya kompetitif tanpa mengurangi kualitas layanan untuk kenyamanan ibadah Anda.</p>
                </div>
                {{-- Kartu 4: Berkah & Amanah --}}
                <div class="parallax-3d-tile group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-3.5 md:p-6 text-center hover:bg-white/[0.08] hover:border-gold/30 transition-all duration-500">
                    <div class="w-11 h-11 md:w-14 md:h-14 mx-auto rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/30 mb-2.5 md:mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-[13px] md:text-base mb-1 md:mb-2">Berkah &amp; Amanah</h3>
                    <p class="text-white/60 text-[11px] md:text-sm leading-relaxed">Setiap langkah kami niatkan ibadah untuk kenyamanan tamu Allah di Tanah Suci.</p>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    {{-- Testimonials --}}
    @if($testimonials->count() > 0)
    <x-testimonial-carousel :testimonials="$testimonials" />
    <x-section-divider />
    @endif

    {{-- Artikel Terpopuler --}}
    @if($articles->count() > 0)
    <section class="px-4 md:px-6 lg:px-8 py-14 md:py-20 max-w-7xl mx-auto relative scroll-reveal">
        <div class="text-center mb-10 md:mb-14">
            <span class="section-label">Artikel</span>
            <h2 class="font-serif text-2xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mt-3">Artikel <span class="text-dark-green">Terpopuler</span></h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 md:gap-6 stagger-children scroll-reveal">
            @foreach($articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="relative card-glass-gold rounded-2xl overflow-hidden group flex flex-col">
                @if($article->image)
                <div class="relative h-48 md:h-52 overflow-hidden">
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" loading="lazy" width="400" height="208" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                </div>
                @else
                <div class="relative h-48 md:h-52 bg-gradient-to-br from-mint to-dark-green/5 overflow-hidden">
                    <div class="absolute inset-0 islamic-pattern-light"></div>
                    <div class="relative h-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="opacity-20"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </div>
                </div>
                @endif
                @if($article->category)
                <span class="absolute top-3 left-3 z-10 inline-flex items-center gap-1.5 bg-gold text-white text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">{{ $article->category->name }}</span>
                @endif
                <div class="p-5 md:p-6 flex flex-col flex-1">
                    <p class="text-[11px] text-slate-500 font-medium mb-2 flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ optional($article->published_at)->format('d M Y') }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 tabular-nums" title="Jumlah dibaca">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                            {{ number_format($article->views, 0, ',', '.') }}
                        </span>
                    </p>
                    <h2 class="text-sm md:text-base font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-dark-green transition-colors">{{ $article->title }}</h2>
                    @if($article->excerpt)
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed line-clamp-2">{{ $article->excerpt }}</p>
                    @endif
                    <div class="mt-auto pt-4 flex items-center text-gold text-xs font-semibold gap-1 group-hover:gap-2 transition-all">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('articles.index') }}"
               class="inline-flex items-center gap-2 btn-gold rounded-xl font-bold text-sm px-7 py-3 shadow-lg shadow-gold/25 hover:shadow-xl hover:shadow-gold/30 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-300">
                Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </section>
    @endif
@endsection
