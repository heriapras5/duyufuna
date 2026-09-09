@extends('layouts.public')

@section('title', $service->meta_title ?: $service->title)
@section('meta_description', $service->meta_description ?: Str::limit(strip_tags($service->description), 160))
@section('seo_keywords', $service->meta_keywords)

@section('no_hero', true)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-7xl mx-auto space-y-8">
    {{-- Title Section (disembunyikan untuk transport karena judul sudah di banner) --}}
    @if($service->category?->pageType() !== 'transport')
    <div class="flex items-center gap-4">
        <a href="{{ route('category.show', $service->category->slug) }}" class="w-7 h-7 md:w-8 md:h-8 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition shrink-0 border border-slate-200/60 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="flex items-center gap-4 min-w-0">
            <div class="min-w-0">
                <h1 class="font-sans text-sm md:text-xl lg:text-2xl font-semibold text-gray-900">{{ $service->title }}</h1>
            </div>
        </div>
    </div>
    @endif

    {{-- Description (Summernote) - dipindah ke dalam layout transport --}}
    @if($service->description && $service->category?->pageType() !== 'transport')
    <div class="bg-white rounded-2xl p-5 md:p-8 border border-gray-100/80 shadow-sm">
        <div class="article-content text-[13px] md:text-sm">{!! $service->description !!}</div>
    </div>
    @endif

    {{-- Transportasi: Layout 2 kolom dengan gallery + sidebar --}}
    @if($service->category?->pageType() === 'transport')
    @php $gallery = $service->galleryImages(); $cap = $service->capacity(); @endphp
    <div class="grid grid-cols-1 lg:grid-cols-[1.35fr_0.65fr] gap-6 md:gap-8 items-start"
         x-data="{
            pickup: '',
            dropoff: '',
            tanggal: '',
            fallbackPrice: {{ $service->price_sar !== null ? (float) $service->price_sar : 'null' }},
            routes: @js($transportRoutes ? $transportRoutes->map(fn($r) => [
                'pickup' => $r->pickup_label,
                'dropoff' => $r->dropoff_label,
                'price' => $r->prices->firstWhere('vehicle', $service->title)?->price !== null ? (float)$r->prices->firstWhere('vehicle', $service->title)->price : null,
            ])->values()->all() : []),

            get pickupOptions() {
                const seen = new Set();
                return this.routes
                    .map(r => r.pickup)
                    .filter(p => !seen.has(p) && seen.add(p));
            },
            get dropoffOptions() {
                if (!this.pickup) return [];
                const seen = new Set();
                return this.routes
                    .filter(r => r.pickup === this.pickup)
                    .map(r => r.dropoff)
                    .filter(d => !seen.has(d) && seen.add(d));
            },
            get matchedRoute() {
                if (this.pickup && this.dropoff) {
                    return this.routes.find(r => r.pickup === this.pickup && r.dropoff === this.dropoff) || null;
                }
                return null;
            },
            get defaultRoute() {
                return this.routes[0] || null;
            },
            get currentRoute() {
                return this.matchedRoute || this.defaultRoute;
            },
            get currentPrice() {
                if (this.matchedRoute?.price != null) return this.matchedRoute.price;
                if (this.pickup) {
                    const candidates = this.routes.filter(r => r.pickup === this.pickup).map(r => r.price).filter(p => p != null);
                    if (candidates.length > 0) return Math.min(...candidates);
                }
                return this.fallbackPrice;
            },
            get priceLabel() {
                if (this.currentPrice === null) return 'Hubungi kami';
                return 'SAR ' + this.fmt(Math.round(this.currentPrice));
            },
            fmt(n) {
                return new Intl.NumberFormat('id-ID').format(Math.round(n));
            },
            fmtDate(d) {
                if (!d) return '';
                const dt = new Date(d + 'T00:00:00');
                if (isNaN(dt.getTime())) return d;
                const p = (n) => String(n).padStart(2, '0');
                return p(dt.getDate()) + '/' + p(dt.getMonth() + 1) + '/' + dt.getFullYear();
            },
            onPickupChange() { this.dropoff = ''; },
         }">
        {{-- Kiri: Gallery + Info + Tarif --}}
        <div class="space-y-5 sm:space-y-6 min-w-0">
            {{-- Header: tombol kembali + judul + badge --}}
            <div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('category.show', $service->category->slug) }}" class="w-7 h-7 md:w-8 md:h-8 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition shrink-0 border border-slate-200/60 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                    <h1 class="font-serif text-xl sm:text-2xl lg:text-[28px] font-bold text-gray-900 leading-tight">{{ $service->title }}</h1>
                </div>
                <div class="mt-2.5 flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gold/10 border border-gold/20 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider text-gold">{{ $service->category?->name ?? 'Transportasi' }}</span>
                    @if($cap)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-50 border border-slate-200 px-2.5 py-1 text-[10px] font-semibold text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        {{ $cap['pax'] }} Pax
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-50 border border-slate-200 px-2.5 py-1 text-[10px] font-semibold text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        {{ $cap['bag'] }} Bag
                    </span>
                    @endif
                    @if($service->price_sar !== null)
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-[10px] font-semibold text-emerald-700">Mulai SAR {{ number_format((float) $service->price_sar, 0, ',', '.') }}</span>
                    @endif
                </div>
            </div>

            {{-- Gallery --}}
            @if(count($gallery) > 0)
            <div class="card-glass-gold rounded-2xl overflow-hidden" x-data="{ active: 0 }">
                <div class="relative aspect-[3/2] sm:aspect-[5/3] md:aspect-[16/10] lg:aspect-[16/9] overflow-hidden bg-white">
                    @foreach($gallery as $i => $img)
                    <a href="{{ Storage::url($img) }}" data-fancybox="transport-gallery"
                       class="absolute inset-0 transition-opacity duration-500 {{ $i === 0 ? '' : 'pointer-events-none' }}"
                       :class="{ 'opacity-0 pointer-events-none': active !== {{ $i }} }">
                        <img src="{{ Storage::url($img) }}" alt="{{ $service->title }} {{ $i + 1 }}"
                             class="w-full h-full object-contain" loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                    </a>
                    @endforeach
                    @if(count($gallery) > 1)
                    <button type="button" @click="active = (active - 1 + {{ count($gallery) }}) % {{ count($gallery) }}"
                            class="absolute left-2 sm:left-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/90 hover:bg-white text-gray-800 shadow-lg flex items-center justify-center transition z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 sm:w-[18px] sm:h-[18px]"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" @click="active = (active + 1) % {{ count($gallery) }}"
                            class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/90 hover:bg-white text-gray-800 shadow-lg flex items-center justify-center transition z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 sm:w-[18px] sm:h-[18px]"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                    @endif
                </div>
                @if(count($gallery) > 1)
                <div class="flex items-center gap-1 sm:gap-1.5 justify-center py-2.5 sm:py-3 bg-white">
                    @foreach($gallery as $i => $img)
                    <button type="button" @click="active = {{ $i }}"
                            class="h-1.5 sm:h-2 rounded-full transition-all"
                            :class="active === {{ $i }} ? 'bg-amber-400 w-4 sm:w-5' : 'bg-gray-300 w-1.5 sm:w-2'"></button>
                    @endforeach
                </div>
                <div class="flex gap-1.5 sm:gap-2 px-3 sm:px-4 pb-3 sm:pb-4 overflow-x-auto scrollbar-thin">
                    @foreach($gallery as $i => $img)
                    <button type="button" @click="active = {{ $i }}"
                            class="shrink-0 w-16 h-11 sm:w-20 sm:h-14 rounded-lg overflow-hidden border-2 transition-all"
                            :class="active === {{ $i }} ? 'border-gold' : 'border-transparent hover:border-gold/40'">
                        <img src="{{ Storage::url($img) }}" alt="" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
            @else
            <div class="card-glass-gold rounded-2xl overflow-hidden">
                <div class="relative aspect-[3/2] sm:aspect-[16/10] lg:aspect-[21/9] bg-white"></div>
            </div>
            @endif

            {{-- Description --}}
            @if($service->description)
            <div class="bg-white rounded-2xl p-5 md:p-6 border border-gray-100/80 shadow-sm">
                <div class="article-content text-[13px] md:text-sm">{!! $service->description !!}</div>
            </div>
            @endif

            {{-- Detail Transportasi (referensi: Pick Up / Drop Off / Rute / Harga) --}}
            @if($transportRoutes && $transportRoutes->count() > 0)
            <div class="card-glass-gold rounded-2xl overflow-hidden">
                <div class="p-4 sm:p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-mint to-emerald-50 flex items-center justify-center ring-1 ring-emerald-200 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 22h14"/><path d="M5 2h14"/><path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/><path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/></svg>
                        </div>
                        <div>
                            <h2 class="font-serif text-sm md:text-base font-bold text-gray-900 leading-tight">Detail Transportasi</h2>
                            <p class="text-[11px] md:text-xs text-gray-500 mt-0.5">Pilih titik jemput & antar untuk melihat tarif {{ $service->title }}</p>
                        </div>
                    </div>

                    <p class="text-[13px] text-slate-600 leading-relaxed">Pilih Pick Up, Drop Off, dan Tanggal Penjemputan pada form pemesanan di samping untuk melihat rute &amp; tarif spesifik {{ $service->title }}.</p>

                    {{-- Ringkasan rute terpilih --}}
                    <div class="mt-4 rounded-xl border border-emerald-100 bg-emerald-50/50 p-4 space-y-0">
                        <template x-if="matchedRoute">
                            <div>
                                <div class="flex items-center gap-2.5">
                                    <span class="text-sm sm:text-base font-bold text-emerald-800 leading-snug" x-text="matchedRoute.pickup"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    <span class="text-sm sm:text-base font-bold text-emerald-800 leading-snug" x-text="matchedRoute.dropoff"></span>
                                </div>
                                <p class="mt-2 text-base sm:text-lg font-extrabold tabular-nums tracking-tight text-dark-green leading-none">
                                    <span x-text="priceLabel"></span>
                                    <span class="text-xs font-medium text-gray-400">/ {{ $service->title }}</span>
                                </p>
                            </div>
                        </template>
                        <template x-if="!matchedRoute">
                            <div class="space-y-2">
                                @if($cap)
                                <p class="text-[13px] text-slate-600">
                                    <span class="font-semibold text-slate-800">{{ $service->title }}</span>
                                    <span class="text-slate-400">Â·</span>
                                    <span>{{ $cap['pax'] }} Pax - {{ $cap['bag'] }} Bag</span>
                                </p>
                                @endif
                                <p class="text-[13px] text-slate-600 leading-relaxed">
                                    Pilih Pick Up, Drop Off, dan Tanggal Penjemputan pada form pemesanan untuk melihat rute &amp; tarif spesifik {{ $service->title }}.
                                </p>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Harga mengikuti ketersediaan armada dan rute. Konfirmasi detail pickup, drop off, dan waktu keberangkatan sebelum pembayaran.
                                </p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Kanan: Sidebar sticky --}}
        <aside class="h-fit min-w-0 scroll-mt-20 lg:scroll-mt-24 lg:sticky lg:top-20">
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                {{-- Price summary --}}
                <div class="px-4 sm:px-5 md:px-6 pt-5 sm:pt-6 pb-4 sm:pb-5 border-b border-slate-100 bg-gradient-to-br from-emerald-50/70 via-white to-white">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">Tarif</p>
                    <p class="mt-2 text-[18px] sm:text-xl font-bold tabular-nums tracking-tight text-dark-green leading-none break-words"
                       x-text="priceLabel">SAR {{ number_format((float) $service->price_sar, 0, ',', '.') }}</p>
                    <p class="mt-1.5 text-[11px] text-slate-500">per kendaraan Â· tarif {{ $service->title }}</p>
                    <div class="mt-3 rounded-xl border border-emerald-100 bg-white px-3 py-2 flex items-center gap-2" x-show="matchedRoute" x-cloak>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0 text-gold"><path d="M5 22h14"/><path d="M5 2h14"/><path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/><path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/></svg>
                        <span class="text-[11px] font-medium text-slate-600 truncate" x-text="matchedRoute?.pickup + ' â†’ ' + matchedRoute?.dropoff"></span>
                    </div>
                    <div class="mt-2 rounded-xl border border-slate-200 bg-white px-3 py-2 flex items-center gap-2" x-show="tanggal" x-cloak>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0 text-gold"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span class="text-[11px] font-medium text-slate-600" x-text="'Penjemputan: ' + fmtDate(tanggal)"></span>
                    </div>
                </div>

                {{-- Form Pemesanan --}}
                <div class="px-4 sm:px-5 md:px-6 py-5 sm:py-6 md:py-7">
                    {{-- Rute & tanggal (scope root agar reaktif ke ringkasan kiri + harga) --}}
                    <div class="space-y-4 sm:space-y-5 mb-4 sm:mb-5">
                        <div>
                            <label class="block text-xs sm:text-[13px] font-semibold text-gray-700 mb-1">Pick Up <span class="text-red-400">*</span></label>
                            <select x-model="pickup" @change="onPickupChange()" required
                                    class="w-full px-3 sm:px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-[13px] sm:text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                                <option value="">Pilih lokasi penjemputan</option>
                                <template x-for="opt in pickupOptions" :key="opt">
                                    <option :value="opt" x-text="opt"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-[13px] font-semibold text-gray-700 mb-1">Drop Off <span class="text-red-400">*</span></label>
                            <select x-model="dropoff" required
                                    class="w-full px-3 sm:px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-[13px] sm:text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                                <option value="">Pilih lokasi tujuan</option>
                                <template x-for="opt in dropoffOptions" :key="opt">
                                    <option :value="opt" x-text="opt"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-[13px] font-semibold text-gray-700 mb-1">Tanggal Penjemputan <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <button type="button"
                                        onclick="const el = this.parentElement.querySelector('input[type=date]'); try { el.showPicker() } catch (e) { el.focus() }"
                                        class="w-full flex items-center px-3 sm:px-4 py-3 pr-16 rounded-xl border border-gray-200 bg-gray-50/50 focus-within:bg-white focus-within:ring-2 focus-within:ring-gold/40 focus-within:border-gold text-[13px] sm:text-sm text-left transition cursor-pointer"
                                        :class="tanggal ? 'text-gray-900' : 'text-gray-400'">
                                    <span x-text="tanggal ? fmtDate(tanggal) : 'dd/mm/yyyy'">dd/mm/yyyy</span>
                                </button>
                                <div class="absolute inset-y-0 right-0 w-16 flex items-center justify-center gap-1 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <input type="date" x-ref="tanggalInput" x-model="tanggal" required min="{{ now()->toDateString() }}" tabindex="-1"
                                       class="absolute inset-y-0 right-0 w-16 opacity-0 pointer-events-none focus:outline-none">
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('customer.store') }}"
                          x-data="{ loading: false, submitted: false }"
                          @submit.prevent="if(!pickup || !dropoff || !tanggal){ alert('Mohon lengkapi Pick Up, Drop Off, dan Tanggal Penjemputan.'); } else if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <input type="hidden" name="item_title" value="{{ $service->title }}">
                        <input type="hidden" name="pickup" :value="pickup">
                        <input type="hidden" name="dropoff" :value="dropoff">
                        <input type="hidden" name="pickup_date" :value="tanggal">
                        @if($service->price_sar !== null)
                        <input type="hidden" name="unit_price" value="{{ (float) $service->price_sar }}">
                        <input type="hidden" name="currency" value="SAR">
                        <input type="hidden" name="unit_label" value="kendaraan">
                        <input type="hidden" name="extra_note" value="Tarif {{ $service->title }} sesuai rute yang dipilih">
                        @endif

                        <p class="font-sans text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Form Pemesanan</p>

                        <div class="space-y-4 sm:space-y-5">
                            <div>
                                <label class="block text-xs sm:text-[13px] font-semibold text-gray-700 mb-1">Nama <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-3.5 flex items-center pointer-events-none text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 sm:w-4 sm:h-4"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                    <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                                           class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-[13px] sm:text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs sm:text-[13px] font-semibold text-gray-700 mb-1">No WhatsApp <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-3.5 flex items-center pointer-events-none text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 sm:w-4 sm:h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    </div>
                                    <input type="tel" name="no_hp" required autocomplete="tel"
                                           class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-[13px] sm:text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                                           placeholder="0812xxxxxxx">
                                </div>
                            </div>

                            <div class="pt-1 sm:pt-2">
                                <button type="submit" :disabled="loading"
                                        class="w-full flex items-center justify-center gap-2 bg-dark-green hover:bg-masjid text-white font-bold rounded-full shadow-lg shadow-dark-green/25 hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 py-2.5 px-4 text-[13px] sm:text-sm">
                                    <span x-show="!loading" class="flex items-center justify-center gap-1.5 sm:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white" class="w-4 h-4 sm:w-5 sm:h-5"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                        Kirim Request
                                    </span>
                                    <span x-show="loading" class="flex items-center justify-center gap-1.5 sm:gap-2">
                                        <svg class="animate-spin h-3.5 w-3.5 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                                        Memproses...
                                    </span>
                                </button>
                            </div>

                            <p class="text-[10px] sm:text-[11px] text-gray-400 text-center leading-relaxed px-2">Dengan mengirim, Anda menyetujui bahwa data Anda akan digunakan untuk keperluan konsultasi sesuai <a href="#" class="text-gold hover:text-amber-500">Kebijakan Privasi</a> kami.</p>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
    </div>
    @endif

    {{-- Service Items (kategori katalog: Hotel / Paket / Produk) --}}
    @if($service->category?->isCatalog() && $service->serviceItems->where('status', true)->count() > 0)
    @php
        $catLabel = $service->category->item_label ?? null;
        $itemLabel = ($catLabel !== null && $catLabel !== '')
            ? $catLabel
            : 'Pilihan';
        $itemHeading = $itemLabel === 'Pilihan' ? 'Pilihan Tersedia' : 'Daftar ' . $itemLabel;
        $itemSubtitle = $itemLabel === 'Pilihan'
            ? 'Berbagai pilihan untuk ' . $service->title
            : 'Pilihan ' . strtolower($itemLabel) . ' yang tersedia untuk Anda';
    @endphp
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100/80 shadow-sm">
        <div class="flex items-center gap-3 mb-6">
            <div>
                <h2 class="text-base font-bold text-gray-900">{{ $itemHeading }}</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $itemSubtitle }}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($service->serviceItems->where('status', true) as $item)
            @include('categories.partials.card', [
                'card' => $item,
                'service' => $service,
            ])
            @endforeach
        </div>
    </div>
    @endif

    {{-- Contact Form (transport sudah punya form di sidebar) --}}
    @if($service->category?->pageType() !== 'transport')
    <div class="rounded-2xl md:rounded-3xl border border-slate-200 bg-white p-6 md:p-8 max-w-lg mx-auto shadow-sm">
        <div class="flex items-center gap-3 mb-2">
            <h3 class="text-lg md:text-xl font-bold text-gray-900 font-sans">Konsultasi</h3>
        </div>
        <p class="text-sm text-gray-400 mb-6">Isi form di bawah untuk informasi lebih lanjut via WhatsApp</p>
        <form method="POST" action="{{ route('customer.store') }}"
              x-data="{
                  loading: false,
                  init() {
                      window.addEventListener('pageshow', () => { this.loading = false; });
                  },
                  submitForm() {
                      this.loading = true;
                      fetch(this.$el.action, {
                          method: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': this.$el.querySelector('input[name=_token]').value,
                              'Accept': 'application/json',
                          },
                          body: new FormData(this.$el),
                      })
                      .then(response => response.json())
                      .then(data => {
                          if (data.redirect_url) {
                              window.location.href = data.redirect_url;
                          }
                      })
                      .catch(err => { alert('Gagal mengirim. Coba lagi.'); })
                      .finally(() => { this.loading = false; });
                  },
              }"
              @submit.prevent="submitForm()">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <input type="text" name="nama" required
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                               placeholder="Nama Anda">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">No WhatsApp <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <input type="tel" name="no_hp" required
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                               placeholder="0812xxxxxxx">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" :disabled="loading"
                            class="w-full bg-dark-green hover:bg-masjid text-white font-bold rounded-full shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300 justify-center py-3.5 px-6 text-sm flex items-center gap-2">
                        <span x-show="!loading" class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Hubungi
                        </span>
                        <span x-show="loading" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                            Memproses...
                        </span>
                    </button>
                </div>

                <p class="text-[11px] text-gray-400 text-center leading-relaxed">Dengan mengirim, Anda menyetujui bahwa data Anda akan digunakan untuk keperluan konsultasi sesuai <a href="#" class="text-gold hover:text-amber-500">Kebijakan Privasi</a> kami.</p>
            </div>
        </form>
    </div>
    @endif

    </div>

@push('modals')
    @include('categories.partials.modal-detail')
    @include('categories.partials.modal-consult')
@endpush
@endsection
