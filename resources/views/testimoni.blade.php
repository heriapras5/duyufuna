@extends('layouts.public')

@section('title', 'Testimoni')
@section('meta_description', 'Testimoni dan pengalaman nyata jamaah yang telah menggunakan layanan ' . ($globalSetting->website_name ?? 'DUYUFUNA') . '.')

@section('no_hero', true)
@section('breadcrumb', 'Testimoni')

@section('content')
    @if($testimonials->count() > 0)
    <section class="px-4 md:px-6 lg:px-8 py-10 md:py-14 max-w-7xl mx-auto scroll-reveal">
        <div class="mb-8">
            <h1 class="font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mt-2">{!! $globalSetting->testimoni_page_title ?? 'Apa Kata <span class="text-dark-green">Jamaah</span>?' !!}</h1>
            <p class="text-sm md:text-base text-gray-500 mt-1">{{ $globalSetting->testimoni_page_subtitle ?? 'Pengalaman nyata dari jamaah yang telah menggunakan layanan kami.' }}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 stagger-children scroll-reveal">
            @foreach($testimonials as $t)
            <div class="card-glass-gold rounded-2xl p-6 md:p-8 h-full flex flex-col hover:border-gold/30 hover:shadow-xl hover:shadow-gold/10 transition-all duration-500">
                <div class="flex items-center gap-1 mb-4 text-gold">
                    @for($i = 0; $i < 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="{{ $i < ($t->rating ?? 5) ? '#C9A227' : 'none' }}" stroke="#C9A227" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed flex-1">"{!! $t->review !!}"</p>
                <div class="flex items-center gap-3 mt-6 pt-5 border-t border-gray-100">
                    @if($t->image)
                    <img src="{{ Storage::url($t->image) }}" width="44" height="44" loading="lazy" class="w-11 h-11 rounded-xl object-cover ring-2 ring-gold/20">
                    @else
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center text-gold font-bold ring-1 ring-gold/20">
                        {{ strtoupper(substr($t->name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $t->name }}</p>
                        <p class="text-xs text-gray-400">Jamaah Umroh</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @else
    <section class="px-4 md:px-6 lg:px-8 py-20 max-w-7xl mx-auto scroll-reveal">
        <div class="text-center">
            <div class="mx-auto w-20 h-20 mb-4 rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada testimoni.</p>
        </div>
    </section>
    @endif
@endsection