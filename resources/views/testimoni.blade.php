@extends('layouts.public')

@section('title', 'Testimoni')
@section('meta_description', 'Testimoni dan pengalaman nyata jamaah yang telah menggunakan layanan ' . ($globalSetting->website_name ?? 'DUYUFUNA') . '.')

@section('no_hero', true)
@section('breadcrumb', 'Testimoni')

@section('content')
    @if($testimonials->count() > 0)
    <section class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-7xl mx-auto scroll-reveal">
        <div class="mb-6 md:mb-8">
            <h1 class="font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{!! $globalSetting->testimoni_page_title ?? 'Apa Kata <span class="text-dark-green">Jamaah</span>?' !!}</h1>
            <p class="text-sm md:text-base text-gray-500 mt-1">{{ $globalSetting->testimoni_page_subtitle ?? 'Pengalaman nyata dari jamaah yang telah menggunakan layanan kami.' }}</p>
        </div>
        {{-- Grid responsif: 1 kolom mobile, 2 tablet, 3 desktop --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 stagger-children scroll-reveal">
@foreach($testimonials as $t)
            <div class="card-glass-gold rounded-2xl p-6 md:p-8 h-full flex flex-col hover:border-gold/30 hover:shadow-xl hover:shadow-gold/10 transition-all duration-500">
                @if($t->image)
                <a href="{{ Storage::url($t->image) }}" data-fancybox="testimoni-galeri" data-caption="Screenshot chat {{ $t->name }}" target="_blank" rel="noreferrer" class="block">
                    {{-- Box memeluk gambar portrait: screenshot chat WA tampil besar & terbaca --}}
                    <div class="mx-auto w-fit max-w-full rounded-xl overflow-hidden border border-gray-200/60 bg-gray-50 p-2 hover:opacity-95 transition">
                        <img src="{{ Storage::url($t->image) }}" alt="Screenshot chat {{ $t->name }}" loading="lazy" class="w-auto max-w-full max-h-[380px] sm:max-h-[440px] lg:max-h-[460px] object-contain rounded-lg">
                    </div>
                </a>
                @endif
                <div class="mt-5 pt-4 border-t border-gray-100 text-center">
                    @if($t->name)
                    <p class="text-sm font-bold text-slate-950">{{ $t->name }}</p>
                    @endif
                    @if($t->review)
                    <p class="mt-2 text-[13px] font-medium text-slate-700 leading-relaxed italic line-clamp-3">"{{ strip_tags($t->review) }}"</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @else
    <section class="px-4 md:px-6 lg:px-8 pt-8 pb-16 max-w-7xl mx-auto scroll-reveal">
        <div class="text-center">
            <div class="mx-auto w-20 h-20 mb-4 rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada testimoni.</p>
        </div>
    </section>
    @endif
@endsection