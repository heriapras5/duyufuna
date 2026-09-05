@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)
@section('og_image', $items->first()?->image)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@php
    $service = $services->first();

    // Data kegiatan untuk Alpine: id, title, harga SAR & IDR (1 SAR = Rp 5.000).
    $kegiatanData = $items->map(fn ($item) => [
        'id'    => $item->id,
        'title' => $item->title,
        'sar'   => $item->price_per_night !== null ? (float) $item->price_per_night : null,
    ])->values()->all();

    $first = $items->first();
@endphp

@push('head')
<style>
/* Ken Burns "breathing" — foto bergerak halus terus-menerus ala galeri premium */
@keyframes fotoBreath {
    0%, 100% { transform: scale(1) translate(0, 0); }
    50%      { transform: scale(1.09) translate(-1.5%, 1%); }
}
.foto-breath { animation: fotoBreath 16s ease-in-out infinite; will-change: transform; }
.swiper-slide:nth-child(4n+2) .foto-breath { animation-delay: -4s; }
.swiper-slide:nth-child(4n+3) .foto-breath { animation-delay: -8s; }
.swiper-slide:nth-child(4n+4) .foto-breath { animation-delay: -12s; }
@media (prefers-reduced-motion: reduce) { .foto-breath { animation: none; } }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Carousel momen per kegiatan: 4 terlihat, bergeser otomatis, pause saat hover.
    document.querySelectorAll('.fotoSwiper').forEach(function (el) {
        if (el.swiper !== undefined) return;
        var slides = el.querySelectorAll('.swiper-slide');
        if (slides.length === 0) return;
        new Swiper(el, {
            modules: [SwiperModules.Autoplay],
            loop: true,
            autoplay: { delay: 2800, disableOnInteraction: false, pauseOnMouseEnter: true },
            breakpoints: {
                0:    { slidesPerView: 2, spaceBetween: 10 },
                1024: { slidesPerView: 4, spaceBetween: 14 },
            },
            speed: 900,
        });
    });
});
</script>
@endpush

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-7xl mx-auto space-y-4 md:space-y-6"
     x-data="{
        kegiatan: '',
        tanggal: '',
        kegiatanData: @js($kegiatanData),
        selected: {
            id: null,
            title: '',
            sar: null,
        },

        get current() {
            return this.kegiatanData.find(k => k.title === this.kegiatan) || null;
        },
        onKegiatanChange() {
            const k = this.current;
            if (k) this.selected = { id: k.id, title: k.title, sar: k.sar };
        },
        fmt(n) {
            return new Intl.NumberFormat('id-ID').format(Math.round(n));
        },
        get sarLabel() {
            return this.selected.sar == null ? '—' : 'SAR ' + this.fmt(this.selected.sar);
        },
        get rpLabel() {
            return this.selected.sar == null ? '—' : 'Rp ' + this.fmt(this.selected.sar * 5000);
        },
     }">

    {{-- Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('home') }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-600 transition shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="flex items-center gap-4">
            <div>
                <h1 class="font-serif text-base sm:text-lg md:text-xl font-bold text-gray-900 leading-tight">{{ $category->name }}</h1>
                @if($category->subtitle)
                <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
                @endif
            </div>
        </div>
    </div>

    @if($service && $items->count() > 0)
    {{-- ===== PILIH KEGIATAN (form request) ===== --}}
    <section id="pilih-kegiatan" class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm scroll-mt-24">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="font-serif text-base sm:text-lg font-bold text-slate-950">Pilih Kegiatan</h2>
                <p class="text-[11px] md:text-xs text-slate-600 mt-0.5">Pilih kegiatan, isi data Anda, lalu kirim request via WhatsApp.</p>
            </div>
            <span class="shrink-0 inline-flex items-center gap-1 rounded-full bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 ring-1 ring-emerald-100">
                {{ $items->count() }} kegiatan
            </span>
        </div>

        <form method="POST" action="{{ route('customer.store') }}"
              x-data="{ loading: false, submitted: false }"
              @submit.prevent="if(!tanggal){ alert('Silakan pilih tanggal kegiatan terlebih dahulu.'); $el.querySelector('input[type=date]').focus(); } else if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(async r => { const d = await r.json().catch(() => ({})); if(r.ok && d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; alert(d.message || 'Tanggal kegiatan wajib diisi. Silakan lengkapi lalu coba lagi.'); } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="item_id" :value="selected.id">
            <input type="hidden" name="item_title" :value="selected.title">
            <input type="hidden" name="unit_price" :value="selected.sar ?? ''">
            <input type="hidden" name="currency" value="SAR">
            <input type="hidden" name="unit_label" value="kegiatan">
            <input type="hidden" name="pickup_date" :value="tanggal">

            {{-- Baris input (gaya filter transportasi) --}}
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 md:gap-3">
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Nama Kegiatan <span class="text-red-400">*</span></span>
                    <select x-model="kegiatan" @change="onKegiatanChange()"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                        <option value="" disabled>Pilih kegiatan</option>
                        @foreach($items as $item)
                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Tanggal Kegiatan <span class="text-red-400">*</span></span>
                    <input type="date" x-model="tanggal" required min="{{ date('Y-m-d') }}"
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                </label>
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Nama Pemesan <span class="text-red-400">*</span></span>
                    <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                </label>
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>No WhatsApp <span class="text-red-400">*</span></span>
                    <input type="tel" name="no_hp" required autocomplete="tel" placeholder="0812xxxxxxx"
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                </label>
            </div>

            {{-- Harga otomatis + tombol kirim --}}
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                <div class="rounded-xl border border-gold/25 bg-amber-50/50 px-4 py-3 space-y-2 min-h-[76px]" x-show="selected?.id" x-cloak>
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-dark-green/80 leading-none">Harga</p>
                        <p class="text-base font-extrabold text-slate-950 tabular-nums leading-none" x-text="sarLabel">—</p>
                    </div>
                    <div class="flex items-center justify-between gap-3 pt-1.5 border-t border-dashed border-gold/20">
                        <p class="text-[11px] font-semibold text-slate-700 leading-none">Estimasi Rupiah</p>
                        <p class="text-sm font-bold text-slate-800 tabular-nums leading-none" x-text="rpLabel">—</p>
                    </div>
                </div>
                <button type="submit" :disabled="loading || !selected?.id"
                        class="shrink-0 inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold rounded-xl shadow-lg shadow-[#25D366]/25 transition py-2.5 px-6 text-sm disabled:opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    <span x-text="loading ? 'Mengirim...' : 'Kirim Request'">Kirim Request</span>
                </button>
            </div>
        </form>
    </section>

    {{-- ===== GALERI KEGIATAN FOTOGRAFER ===== --}}
    <section id="galeri-kegiatan" class="mt-6 md:mt-8 scroll-mt-24">
        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <h2 class="font-serif text-lg sm:text-xl md:text-2xl font-bold text-slate-950">Galeri Kegiatan Fotografer</h2>
            </div>

            {{-- 1 kegiatan = 1 showcase: header editorial + carousel 4 kolom auto-slide --}}
            <div class="mt-5 md:mt-6 space-y-10 md:space-y-12">
            @foreach($items as $item)
            @php
                $g = $item->galleryImages();
                // Gandakan slide hingga >= 8 agar loop Swiper mulus (aman untuk 1-3 foto).
                $slides = $g;
                if ($slides !== []) {
                    while (count($slides) < 8) {
                        $slides = array_merge($slides, $g);
                    }
                }
            @endphp
            <article class="scroll-reveal group/section">
                {{-- Header editorial: judul kegiatan --}}
                <div class="flex items-end justify-between gap-3 md:gap-4 mb-4 md:mb-5">
                    <div class="min-w-0 pb-0.5">
                        <h3 class="font-serif text-base sm:text-lg font-bold text-slate-950 leading-tight">{{ $item->title }}</h3>
                    </div>
                </div>

                {{-- Carousel momen: 4 kolom terlihat, bergeser otomatis --}}
                <div class="swiper fotoSwiper overflow-hidden">
                    <div class="swiper-wrapper">
                        @forelse($slides as $gi => $path)
                        @php $n = count($g) > 0 ? ($gi % count($g)) + 1 : $gi + 1; @endphp
                        <div class="swiper-slide h-auto">
                            <a href="{{ Storage::url($path) }}" data-fancybox="foto-{{ $item->id }}"
                               class="foto-tile group relative block overflow-hidden cursor-pointer rounded-2xl md:rounded-[1.75rem] ring-1 ring-gold/20 hover:ring-gold/50 shadow-lg shadow-slate-900/10 hover:shadow-2xl hover:shadow-emerald-950/25 transition-all duration-500">
                                {{-- Foto bernapas (Ken Burns) --}}
                                <img src="{{ Storage::url($path) }}" alt="{{ $item->title }} — momen {{ $n }}" loading="lazy" width="800" height="600"
                                     class="foto-breath w-full aspect-[4/3] object-cover">
                                {{-- Overlay hover --}}
                                <div class="absolute inset-0 bg-dark-green/0 group-hover:bg-dark-green/10 transition-colors duration-500"></div>
                                {{-- Tombol expand muncul saat hover --}}
                                <span class="absolute top-2.5 right-2.5 md:top-4 md:right-4 w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/15 backdrop-blur-md border border-white/30 flex items-center justify-center text-white shadow-lg opacity-0 scale-75 group-hover:opacity-100 group-hover:scale-100 transition-all duration-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M9 21H3v-6"/><path d="M21 3l-7 7"/><path d="M3 21l7-7"/></svg>
                                </span>
                            </a>
                        </div>
                        @empty
                        {{-- Fallback placeholder saat kegiatan belum punya foto --}}
                        @for($n = 1; $n <= 4; $n++)
                        <div class="swiper-slide h-auto">
                            <div class="relative block overflow-hidden rounded-2xl md:rounded-[1.75rem] ring-1 ring-gold/20 shadow-lg shadow-slate-900/10 bg-gradient-to-br from-emerald-950 via-dark-green to-slate-900">
                                <div class="w-full aspect-[4/3] flex flex-col items-center justify-center gap-1.5 text-white/80">
                                    <span class="text-2xl md:text-3xl">📸</span>
                                    <p class="font-serif font-bold text-xs md:text-sm px-3 text-center leading-tight">{{ $item->title }}</p>
                                    <p class="text-[10px] md:text-[11px] text-white/60">Foto segera hadir</p>
                                </div>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    </section>
    @else
    <div class="text-center py-10 card-glass-gold rounded-2xl p-6 mt-6">
        <p class="text-gray-400 text-sm">Segera Hadir</p>
        <p class="text-gray-300 text-xs mt-1">Kegiatan fotografer sedang dipersiapkan.</p>
    </div>
    @endif
</div>

@push('modals')
    @include('categories.partials.modal-consult')
@endpush
@endsection
