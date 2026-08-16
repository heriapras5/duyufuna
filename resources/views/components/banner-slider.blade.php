@props(['service' => null, 'category' => null])
@php
    if ($service) {
        $banners = $service->banners()->where('status', true)->get();
    } elseif ($category) {
        $banners = $category->banners()->where('status', true)->get();
    } else {
        $banners = $headerBanners;
    }
@endphp
@if($banners->count() > 0)
<div class="bannerSlider absolute inset-0" data-banner-slider>
    @foreach($banners as $banner)
    <div class="banner-slide absolute inset-0 {{ $loop->first ? 'is-active' : '' }}" data-slide>
        <img src="{{ Storage::url($banner->image) }}" alt="{{ $globalSetting->website_name ?? 'DUYUFUNA' }} — Banner"
             class="w-full h-full object-cover object-[center_20%]"
             @if($loop->first) fetchpriority="high" @else loading="lazy" @endif>
        @if($banner->title || $banner->subtitle)
        <div class="absolute inset-x-0 bottom-4 md:bottom-8 z-40 px-5 md:px-10 pointer-events-none">
            <div class="max-w-7xl mx-auto w-full">
                <div class="inline-flex flex-col rounded-xl bg-black/35 backdrop-blur-[2px] px-4 py-3 md:px-6 md:py-4 max-w-xl">
                    @if($banner->title)
                    <h2 class="font-serif text-lg sm:text-xl md:text-3xl lg:text-4xl font-bold text-white leading-tight drop-shadow-lg">{{ $banner->title }}</h2>
                    @endif
                    @if($banner->subtitle)
                    <p class="text-white/95 text-xs sm:text-sm md:text-lg mt-1 md:mt-2 leading-relaxed drop-shadow-md">{{ $banner->subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    @endforeach
    @if($banners->count() > 1)
    <button type="button" class="banner-nav banner-nav-prev" data-banner-prev aria-label="Banner sebelumnya">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </button>
    <button type="button" class="banner-nav banner-nav-next" data-banner-next aria-label="Banner selanjutnya">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
    </button>
    @endif
</div>
@else
<div class="absolute inset-0 bg-gradient-to-br from-masjid to-emerald-900 islamic-pattern">
    <div class="absolute top-0 right-0 w-64 h-64 bg-gold/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-primary/5 rounded-full blur-3xl"></div>
</div>
@endif
