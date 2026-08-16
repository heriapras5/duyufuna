@extends('layouts.public')

@section('title', 'Tentang Kami')
@section('meta_description', 'Kenali lebih dekat ' . ($globalSetting->website_name ?? 'DUYUFUNA') . ' dan komitmen kami dalam memberikan layanan umroh terbaik.')

@section('no_hero', true)
@section('breadcrumb', 'Tentang Kami')

@section('content')
    @php
        $aboutImage = $setting->about_image ?? null;
        if (!$aboutImage && $setting->about_banner) $aboutImage = $setting->about_banner;
        $waService = app(\App\Services\WhatsAppService::class);
        $waMessage = $waService->message($setting->wa_message ?? '', [
            'nama' => '', 'no_hp' => '',
            'kategori' => '', 'layanan' => '',
            'website' => $setting->website_name ?? '',
        ]);
        $waUrl = $waService->url(null, $setting->whatsapp, $waMessage);
    @endphp

    <section class="px-4 sm:px-6 lg:px-8 py-10 md:py-20">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] gap-8 lg:gap-16 items-start">

            <div class="scroll-reveal-left lg:sticky lg:top-24 self-start">
                <div class="relative mx-auto max-w-xl lg:max-w-none">
                    <div class="rounded-2xl overflow-hidden ring-1 ring-gray-100 shadow-[0_12px_36px_-14px_rgba(16,24,40,0.18)]">
                        @if($aboutImage)
                        <img src="{{ Storage::url($aboutImage) }}" alt="{{ $setting->about_title ?? 'Tentang Kami' }}" loading="lazy" class="w-full h-auto object-cover lg:h-[480px]">
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
                @if($setting && $setting->about_body)
                <div class="article-content">
                    {!! \Illuminate\Support\Str::markdown($setting->about_body ?? '') !!}
                </div>
                @else
                <p class="text-gray-500 leading-relaxed">Belum ada konten untuk halaman ini. Silakan lengkapi melalui pengaturan admin.</p>
                @endif

                @if($setting)
                <div class="mt-10">
                    <a href="{{ $waUrl }}" class="inline-flex w-full sm:w-auto items-center justify-center gap-2.5 bg-dark-green hover:bg-masjid text-white font-semibold text-sm sm:text-base rounded-full px-7 py-4 sm:py-3.5 transition-colors shadow-lg shadow-dark-green/20 active:scale-[0.98]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                        Konsultasi via WhatsApp
                    </a>
                </div>
                @endif
            </div>
        </div>
        </div>
    </section>
@endsection
