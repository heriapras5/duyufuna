@php
    $copyright = (string) ($globalSetting->footer_copyright ?? '© {year} {website}. All rights reserved.');
    $copyright = str_replace(['{year}', '{website}'], [date('Y'), $globalSetting->website_name ?? 'DUYUFUNA'], $copyright);
    $waFooterDisplay = $globalSetting?->whatsapp ?: '081293679502';
@endphp
<footer class="bg-masjid relative overflow-hidden islamic-pattern">
    <div class="absolute top-0 left-0 w-96 h-96 bg-gold/5 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/4"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl translate-y-1/2 translate-x-1/4"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-10 md:py-12 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-12">
            <div class="md:col-span-6 flex flex-col items-start text-left">
                <div class="flex items-center gap-2.5 mb-3">
                    @if($globalSetting && $globalSetting->logo)
                    <div class="w-10 h-10 md:w-11 md:h-11 rounded-lg bg-white/10 p-1 flex items-center justify-center shrink-0 transition-colors duration-300 hover:bg-white/15">
                        <img src="{{ Storage::url($globalSetting->logo) }}" alt="{{ $globalSetting->website_name ?? 'Logo' }}" width="48" height="48" loading="lazy" class="w-full h-full object-contain transition-all duration-300 hover:scale-105 hover:drop-shadow-[0_0_10px_rgba(245,215,110,0.55)] hover:brightness-110">
                    </div>
                    @else
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gold to-amber-500 flex items-center justify-center shadow-lg shadow-gold/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/><path d="M12 2v20" stroke="#F5D76E" stroke-width="2.5"/></svg>
                    </div>
                    @endif
                    <div>
                        <h3 class="text-white font-bold text-base md:text-lg tracking-wide font-serif">{{ $globalSetting->website_name ?? 'DUYUFUNA' }}</h3>
                        <p class="text-[9px] font-semibold text-gold-light tracking-widest uppercase mt-0.5">{{ $globalSetting->tagline ?? 'MELAYANI TAMU ALLAH, SEPENUH HATI' }}</p>
                    </div>
                </div>
                <div class="text-white/90 text-sm leading-relaxed max-w-sm mt-4">
                    @if($globalSetting && $globalSetting->footer_text)
                    {!! $globalSetting->footer_text !!}
                    @else
                    Platform layanan umroh terlengkap. Solusi perjalanan umroh Anda dengan layanan terbaik, amanah, dan terpercaya.
                    @endif
                </div>
                @if($globalSetting && ($globalSetting->social_instagram ?? $globalSetting->social_facebook ?? $globalSetting->social_youtube ?? $globalSetting->social_tiktok))
                <div class="flex items-center gap-2.5 mt-5">
                    @if($globalSetting->social_instagram)
                    <a href="{{ $globalSetting->social_instagram }}" target="_blank" aria-label="Instagram" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:scale-110 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none">
                            <defs>
                                <linearGradient id="ig-gradient" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#F58529"/>
                                    <stop offset="25%" stop-color="#DD2A7B"/>
                                    <stop offset="50%" stop-color="#8134AF"/>
                                    <stop offset="75%" stop-color="#515BD4"/>
                                </linearGradient>
                            </defs>
                            <path stroke="url(#ig-gradient)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    @endif
                    @if($globalSetting->social_facebook)
                    <a href="{{ $globalSetting->social_facebook }}" target="_blank" aria-label="Facebook" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:scale-110 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    @if($globalSetting->social_youtube)
                    <a href="{{ $globalSetting->social_youtube }}" target="_blank" aria-label="YouTube" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:scale-110 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"><path fill="#FF0000" d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/><path fill="#ffffff" d="M9.545 8.432v7.136L15.818 12 9.545 8.432z"/></svg>
                    </a>
                    @endif
                    @if(isset($globalSetting->social_tiktok) && $globalSetting->social_tiktok)
                    <a href="{{ $globalSetting->social_tiktok }}" target="_blank" aria-label="TikTok" class="w-8 h-8 rounded-lg bg-white hover:bg-gray-100 flex items-center justify-center transition-all hover:scale-110 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="#000000"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>
            <div class="md:col-span-6 flex flex-col items-start text-left pt-8 border-t border-white/10 md:pt-0 md:border-t-0">
                <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-8">
                    <div>
                        <h4 class="text-white font-semibold text-sm mb-5 tracking-wide">{{ $globalSetting->footer_contact_heading ?? 'Hubungi Kami' }}</h4>
                        <div class="space-y-3.5">
                            @if($globalSetting && $globalSetting->address)
                            <div class="flex items-start gap-3 text-white/60 text-sm group">
                                <div class="w-7 h-7 shrink-0 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-gold/20 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <span class="leading-relaxed">{{ $globalSetting->address }}</span>
                            </div>
                            @endif
                            @if($globalSetting)
                            <div class="flex items-start gap-3 text-white/60 text-sm">
                                <div class="w-7 h-7 shrink-0 rounded-lg bg-white/5 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                                </div>
                                <span>{{ $waFooterDisplay }}</span>
                            </div>
                            @endif
                            @if($globalSetting && $globalSetting->email)
                            <a href="mailto:{{ $globalSetting->email }}" class="flex items-start gap-3 text-white/60 hover:text-gold-light transition-colors text-sm group">
                                <div class="w-7 h-7 shrink-0 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-gold/20 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                </div>
                                <span>{{ $globalSetting->email }}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="pt-8 border-t border-white/10 sm:pt-0 sm:border-t-0">
                        @php
                            $links = [];
                            if ($globalSetting && $globalSetting->footer_links) {
                                foreach (preg_split('/\r\n|\r|\n/', $globalSetting->footer_links) as $line) {
                                    $line = trim($line);
                                    if ($line === '') continue;
                                    $parts = array_map('trim', explode('|', $line, 2));
                                    $links[] = ['label' => $parts[0] ?? '', 'url' => $parts[1] ?? '#'];
                                }
                            }
                            if (empty($links)) {
                                $links = $defaultFooterLinks ?? [
                                    ['label' => 'Beranda', 'url' => route('home')],
                                    ['label' => 'Tentang Kami', 'url' => route('pages.tentang')],
                                    ['label' => 'Artikel', 'url' => route('articles.index')],
                                    ['label' => 'Galeri Layanan', 'url' => route('pages.galeri')],
                                    ['label' => 'Testimoni', 'url' => route('pages.testimoni')],
                                    ['label' => 'FAQ', 'url' => route('pages.faq')],
                                ];
                            }
                        @endphp
                        <h4 class="text-white font-semibold text-sm mb-5 tracking-wide">{{ $globalSetting->footer_links_heading ?? 'Quick Links' }}</h4>
                        <ul class="space-y-2">
                            @foreach($links as $link)
                            <li><a href="{{ $link['url'] }}" class="text-white/50 hover:text-gold-light transition text-sm">{{ $link['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-t border-white/5 relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-5 text-center">
            <p class="text-white/40 text-xs">{{ $copyright }}</p>
        </div>
    </div>
</footer>
