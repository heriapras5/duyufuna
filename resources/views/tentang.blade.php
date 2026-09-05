@extends('layouts.public')

@section('title', 'Tentang Kami')
@section('meta_description', 'Kenali lebih dekat ' . ($globalSetting->website_name ?? 'DUYUFUNA') . ' dan komitmen kami dalam memberikan layanan umroh terbaik.')

@section('no_hero', true)
@section('breadcrumb', 'Tentang Kami')

@section('content')
    @php
        $aboutImage = $setting->about_image ?? null;
        if (!$aboutImage && $setting->about_banner) $aboutImage = $setting->about_banner;
    @endphp

    <section class="px-4 sm:px-6 lg:px-8 pt-4 pb-10 md:pt-6 md:pb-16">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] gap-8 lg:gap-16 items-start">

                <div class="scroll-reveal-left lg:sticky lg:top-24 self-start">
                    <div class="relative mx-auto max-w-xl lg:max-w-none">
                        <div class="rounded-2xl overflow-hidden ring-1 ring-gray-100 shadow-[0_12px_36px_-14px_rgba(16,24,40,0.18)]">
                            @if($aboutImage)
                            <img src="{{ Storage::url($aboutImage) }}" alt="{{ $setting->about_title ?? 'Tentang Kami' }}" loading="lazy" class="w-full h-auto object-cover">
                            @else
                            <div class="relative w-full aspect-square bg-emerald-50 flex items-center justify-center overflow-hidden">
                                <div class="relative w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center ring-1 ring-emerald-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 left-6 right-6 h-3 bg-gradient-to-r from-gold/40 via-transparent to-dark-green/30 blur-md pointer-events-none"></div>
                    </div>
                </div>

                <div class="scroll-reveal-right min-w-0">
                    <h1 class="font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight tracking-tight mb-5">{{ $setting->about_title ?? 'Tentang Kami' }}</h1>
                    @if($setting && $setting->about_body)
                    <div class="article-content text-[15px] md:text-base leading-8 text-slate-700">
                        {!! \Illuminate\Support\Str::markdown($setting->about_body ?? '') !!}
                    </div>
                    @else
                    <p class="text-gray-500 leading-relaxed">Belum ada konten untuk halaman ini. Silakan lengkapi melalui pengaturan admin.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
