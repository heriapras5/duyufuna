@extends('layouts.public')

@section('title', 'Tentang Kami')
@section('meta_description', 'Kenali lebih dekat ' . ($globalSetting->website_name ?? 'DUYUFUNA') . ' dan komitmen kami dalam memberikan layanan umroh terbaik.')

@section('no_hero', true)

@section('content')
    @php
        $aboutImage = $setting->about_image ?? null;
        if (!$aboutImage && $setting->about_banner) $aboutImage = $setting->about_banner;
    @endphp

    <section class="px-4 sm:px-6 lg:px-8 pt-5 pb-12 md:pt-8 md:pb-16">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 xl:gap-16 items-start">

                {{-- Kolom gambar: sticky di desktop, rasio 4:3 konsisten --}}
                <div class="scroll-reveal-left lg:col-span-5 lg:sticky lg:top-24 self-start">
                    <div class="relative mx-auto max-w-xl lg:max-w-none">
                        <div class="rounded-2xl overflow-hidden ring-1 ring-gray-100 shadow-[0_12px_36px_-14px_rgba(16,24,40,0.18)]">
                            @if($aboutImage)
                            <img src="{{ Storage::url($aboutImage) }}" alt="{{ $setting->about_title ?? 'Tentang Kami' }}" loading="lazy" class="w-full h-auto">
                            @else
                            <div class="relative w-full aspect-[4/3] bg-emerald-50 flex items-center justify-center overflow-hidden">
                                <div class="relative w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center ring-1 ring-emerald-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 left-6 right-6 h-3 bg-gradient-to-r from-gold/40 via-transparent to-dark-green/30 blur-md pointer-events-none"></div>
                    </div>
                </div>

                {{-- Kolom teks: pill + judul + konten admin --}}
                <div class="scroll-reveal-right lg:col-span-7 min-w-0">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 ring-1 ring-emerald-100 uppercase tracking-[0.14em]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        Tentang Kami
                    </span>
                    <h1 class="mt-3 font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight tracking-tight">{{ $setting->about_title ?? 'Tentang Kami' }}</h1>
                    <div class="mt-2 w-14 h-1 rounded-full bg-gradient-to-r from-gold to-dark-green/60"></div>

                    @if($setting && $setting->about_body)
                    <div class="article-content max-w-3xl lg:max-w-none mt-6 text-[15px] md:text-base leading-8 text-slate-700">
                        {!! \Illuminate\Support\Str::markdown($setting->about_body ?? '') !!}
                    </div>
                    @else
                    <div class="mt-6 rounded-2xl border border-dashed border-gray-200 bg-gray-50/60 p-6">
                        <p class="text-gray-500 leading-relaxed text-sm md:text-base">Belum ada konten untuk halaman ini. Silakan lengkapi melalui pengaturan admin.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
