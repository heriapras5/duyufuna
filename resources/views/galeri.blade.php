@extends('layouts.public')

@section('title', 'Galeri Layanan')
@section('meta_description', 'Lihat dokumentasi layanan ' . ($globalSetting->website_name ?? 'DUYUFUNA') . ' — hotel, visa, transportasi, handling, catering, dan lainnya.')

@section('no_hero', true)
@section('breadcrumb', 'Galeri Layanan')

@section('content')
    <section class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-7xl mx-auto scroll-reveal">
        <div class="mb-6 md:mb-8">
            <h1 class="font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{{ $globalSetting->galeri_page_title ?? 'Galeri Layanan' }}</h1>
            <p class="text-sm md:text-base text-gray-500 mt-1">{{ $globalSetting->galeri_page_subtitle ?? 'Dokumentasi pelayanan terbaik kami untuk para jamaah.' }}</p>
        </div>
        @if($galleries->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-5 stagger-children scroll-reveal">
            @foreach($galleries as $g)
            <a href="{{ Storage::url($g->image) }}" data-fancybox="galeri"
               @if($g->title || $g->description) data-caption="{{ $g->title }}{{ $g->description ? ' — ' . strip_tags($g->description) : '' }}" @endif
               class="relative block rounded-2xl md:rounded-3xl overflow-hidden group cursor-pointer shadow-md shadow-gold/5 hover:shadow-2xl hover:shadow-gold/15 transition-all duration-500">
                <img src="{{ Storage::url($g->image) }}" alt="{{ $g->title }}" loading="lazy" width="800" height="600" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 hidden md:block bg-gradient-to-t from-dark-green/80 via-dark-green/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute top-3 right-3 hidden md:flex w-9 h-9 md:w-10 md:h-10 rounded-full bg-white/90 backdrop-blur items-center justify-center text-dark-green shadow-lg opacity-100 scale-100 md:opacity-0 md:scale-75 md:group-hover:opacity-100 md:group-hover:scale-100 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/><path d="M11 8v6"/><path d="M8 11h6"/></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 hidden md:block p-4 md:p-5 translate-y-0 opacity-100 md:translate-y-2 md:opacity-0 md:group-hover:translate-y-0 md:group-hover:opacity-100 transition-all duration-500">
                    <p class="text-white font-bold text-sm md:text-base drop-shadow">{{ $g->title }}</p>
                    @if($g->description)
                    <p class="text-white/70 text-xs md:text-sm leading-relaxed mt-1">{!! $g->description !!}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-10">{{ $galleries->links() }}</div>
        @else
        <div class="text-center py-20">
            <div class="mx-auto w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada foto dalam galeri.</p>
        </div>
        @endif
    </section>
@endsection