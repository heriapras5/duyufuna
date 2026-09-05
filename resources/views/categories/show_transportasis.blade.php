@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)
@section('og_image', $services->first()?->image)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@php
    // Data rute untuk kalkulasi harga (Alpine)
    $routeData = $routes->map(fn ($r) => [
        'code' => $r->code,
        'pickup' => $r->pickup_label,
        'dropoff' => $r->dropoff_label,
        'prices' => $r->prices->mapWithKeys(fn ($p) => [$p->vehicle => $p->price !== null ? (float) $p->price : null])->all(),
    ])->values()->all();

    $vehicles = $services->pluck('title')->values()->all();
    $pickupOptions = $routes->pluck('pickup_label')->unique()->values()->all();
    $vehicleList = $services->map(fn ($s) => [
        'id' => $s->id,
        'title' => $s->title,
        'price' => $s->price_sar !== null ? (float) $s->price_sar : null,
    ])->values()->all();
@endphp

@push('head')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.armadaSwiper');
    if (el && el.swiper === undefined) {
        var slides = el.querySelectorAll('.swiper-slide');
        if (slides.length > 0) {
            new Swiper(el, {
                modules: [SwiperModules.Autoplay],
                loop: slides.length > 3,
                autoplay: { delay: 2600, disableOnInteraction: false, pauseOnMouseEnter: true },
                breakpoints: {
                    0: { slidesPerView: 2, spaceBetween: 10 },
                    640: { slidesPerView: 3, spaceBetween: 12 },
                    1024: { slidesPerView: 3, spaceBetween: 14 },
                },
                speed: 650,
            });
        }
    }
});
</script>
@endpush

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-7xl mx-auto space-y-4 md:space-y-6"
     x-data="{
        pickup: '',
        dropoff: '',
        vehicle: '',
        tanggal: '',
        applied: false,
        routes: @js($routeData),
        vehicles: @js($vehicles),
        vehicleMeta: @js($vehicleList),
        pickupOptions: @js($pickupOptions),
        selected: { id: null, title: '', price: null },
        qty: 1,
        formOpen: false,

        openForm() {
            this.formOpen = true;
        },
        init() {
            this.$watch('formOpen', (value) => this.$dispatch('hide-bottom-nav', value));
        },

        get dropoffOptions() {
            if (!this.pickup) return [];
            const seen = new Set();
            return this.routes
                .filter(r => r.pickup === this.pickup)
                .map(r => r.dropoff)
                .filter(d => !seen.has(d) && seen.add(d));
        },

        get matchedRoutes() {
            return this.routes.filter(r =>
                (!this.pickup || r.pickup === this.pickup) &&
                (!this.dropoff || r.dropoff === this.dropoff)
            );
        },

        get priceInfo() {
            const vehicle = this.vehicle || this.selected?.title;
            if (!vehicle) return null;
            const matches = this.matchedRoutes
                .map(r => r.prices[vehicle])
                .filter(p => p !== null && p !== undefined);
            if (matches.length === 0) return null;
            const min = Math.min(...matches);
            const max = Math.max(...matches);
            return { min, max, single: min === max };
        },

        get priceLabel() {
            const info = this.priceInfo;
            if (!info) return null;
            return info.single
                ? 'SAR ' + this.fmt(info.min)
                : 'SAR ' + this.fmt(info.min) + ' - ' + this.fmt(info.max);
        },

        routePriceFor(vehicle) {
            if (!this.pickup || !this.dropoff) return null;
            const match = this.routes.find(r =>
                r.pickup === this.pickup && r.dropoff === this.dropoff
            );
            if (!match) return null;
            const price = match.prices[vehicle];
            if (price === null || price === undefined) return null;
            return 'SAR ' + this.fmt(price);
        },

        get sidebarPriceLabel() {
            const exact = this.routePriceFor(this.selected?.title);
            if (exact) return { label: 'Harga Rute', text: exact };
            if (this.selected?.price != null) return { label: 'Mulai Dari', text: 'SAR ' + this.fmt(this.selected.price) };
            return { label: 'Mulai Dari', text: '—' };
        },
        get unitPrice() {
            const t = this.sidebarPriceLabel.text;
            const m = String(t).replace(/\./g, '').match(/(\d+)/);
            return m ? parseInt(m[1], 10) : null;
        },
        get totalLabel() {
            if (this.unitPrice == null) return '—';
            return 'SAR ' + this.fmt(this.unitPrice * this.qty);
        },

        fmt(n) {
            return new Intl.NumberFormat('id-ID').format(Math.round(n));
        },

        fmtDate(d) {
            if (!d) return '';
            const dt = new Date(d + 'T00:00:00');
            if (isNaN(dt.getTime())) return d;
            return new Intl.DateTimeFormat('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }).format(dt);
        },

        routeAvailable(vehicle) {
            if (!this.applied) return true;
            const rs = this.routes.filter(r =>
                (!this.pickup || r.pickup === this.pickup) &&
                (!this.dropoff || r.dropoff === this.dropoff)
            );
            if (!this.pickup && !this.dropoff) return true;
            return rs.some(r => r.prices[vehicle] != null);
        },
        showVehicle(vehicle) {
            if (!this.applied) return true;
            if (this.vehicle && this.vehicle !== vehicle) return false;
            if (this.pickup || this.dropoff) return this.routeAvailable(vehicle);
            return true;
        },
        get visibleCount() {
            if (!this.applied) return this.vehicles.length;
            return this.vehicles.filter(v => this.showVehicle(v)).length;
        },
        get hasActiveFilter() {
            return this.applied && (this.pickup || this.dropoff || this.vehicle || this.tanggal);
        },
        onPickupChange() {
            this.dropoff = '';
            // Perubahan dropdown TIDAK langsung menyaring — user menekan tombol Filter.
            if (this.applied) this.applyFilter();
        },

        resetFilter() {
            this.pickup = '';
            this.dropoff = '';
            this.vehicle = '';
            this.tanggal = '';
            this.applied = false;
        },

        closeMobileFilter() {
            const el = this.$refs.mobileFilter;
            if (el) el.removeAttribute('open');
        },

        applyFilter() {
            this.applied = true;
            this.closeMobileFilter();
            const el = document.getElementById('armada');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        },

        selectVehicle(v) {
            this.selected = { id: v.id, title: v.title, price: v.price };
            this.vehicle = v.title;
            if (window.innerWidth < 1024) this.formOpen = true;
        },

        onVehicleChange() {
            const v = this.vehicleMeta.find(x => x.title === this.vehicle);
            if (v) {
                this.selected = { id: v.id, title: v.title, price: v.price };
            }
        },

        consultContext(serviceTitle) {
            const parts = [serviceTitle];
            if (this.pickup) parts.push('Pick Up: ' + this.pickup);
            if (this.dropoff) parts.push('Drop Off: ' + this.dropoff);
            if (this.tanggal) parts.push('Tgl Penjemputan: ' + this.fmtDate(this.tanggal));
            return parts.join(' · ');
        },

        consult(serviceId, serviceTitle) {
            this.$store.modal.setConsult({
                service_id: serviceId,
                item_title: this.consultContext(serviceTitle),
                title: serviceTitle,
            });
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

    @if($services->count() > 0 && count($routeData) > 0)
    {{-- ===== LAYOUT UTAMA: 2 Kolom (kiri full-width + kanan form) ===== --}}
    <section class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_340px] gap-3 sm:gap-4 items-start mt-4">
        {{-- KOLOM KIRI: wrapper putih --}}
        <div class="min-w-0 rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm">
            {{-- Carousel Kendaraan Tersedia --}}
            @if($services->count() > 0)
            <div>
                <h2 class="font-serif text-sm md:text-base font-bold text-gray-900 leading-tight mb-3">Transportasi Tersedia</h2>
                <div class="swiper armadaSwiper overflow-visible -mx-1">
                    <div class="swiper-wrapper">
                        @foreach($services as $service)
                        <div class="swiper-slide h-auto px-1">
                            @include('categories.partials.transport-carousel-card', [
                                'service' => $service,
                            ])
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-5 pt-4 border-t border-dashed border-slate-200"></div>
            @endif

            {{-- Header --}}
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h1 class="font-serif text-base sm:text-lg font-bold text-slate-950">Pilih Transportasi</h1>
                    <p class="text-[11px] md:text-xs text-slate-600 mt-0.5">Pilih rute lalu tekan Filter untuk menampilkan kendaraan yang cocok.</p>
                </div>
                <span class="shrink-0 inline-flex items-center gap-1 rounded-full bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 ring-1 ring-emerald-100">
                    <span x-text="visibleCount"></span> kendaraan
                </span>
            </div>

            {{-- Ringkasan filter aktif --}}
            <div x-show="hasActiveFilter" x-cloak class="mt-2 flex flex-wrap items-center gap-1.5 text-[11px]">
                <template x-if="pickup">
                    <span class="inline-flex items-center rounded-full bg-gold/10 border border-gold/20 px-2 py-0.5 font-semibold text-amber-700" x-text="pickup"></span>
                </template>
                <svg x-show="pickup && dropoff" x-cloak xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0 text-emerald-500"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                <template x-if="dropoff">
                    <span class="inline-flex items-center rounded-full bg-gold/10 border border-gold/20 px-2 py-0.5 font-semibold text-amber-700" x-text="dropoff"></span>
                </template>
                <template x-if="vehicle">
                    <span class="inline-flex items-center rounded-full bg-slate-100 border border-slate-200 px-2 py-0.5 font-semibold text-slate-600" x-text="vehicle"></span>
                </template>
                <template x-if="tanggal">
                    <span class="inline-flex items-center rounded-full bg-slate-100 border border-slate-200 px-2 py-0.5 font-semibold text-slate-600" x-text="'Penjemputan: ' + fmtDate(tanggal)"></span>
                </template>
                <span class="text-slate-500">·</span>
                <span class="text-slate-600" x-text="visibleCount + ' kendaraan cocok'"></span>
            </div>

            {{-- Filter --}}
            <div class="mt-3 grid grid-cols-2 lg:grid-cols-[1fr_1fr_1fr_1fr_auto] gap-2.5 md:gap-3 items-end">
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Pick Up</span>
                    <select x-model="pickup" @change="onPickupChange()" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                        <option value="">Semua Pick Up</option>
                        <template x-for="opt in pickupOptions" :key="opt">
                            <option :value="opt" x-text="opt"></option>
                        </template>
                    </select>
                </label>
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Drop Off</span>
                    <select x-model="dropoff" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                        <option value="">Semua Drop Off</option>
                        <template x-for="opt in dropoffOptions" :key="opt">
                            <option :value="opt" x-text="opt"></option>
                        </template>
                    </select>
                </label>
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Jenis Kendaraan</span>
                    <select x-model="vehicle" @change="onVehicleChange()" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                        <option value="">Semua kendaraan</option>
                        <template x-for="v in vehicles" :key="v">
                            <option :value="v" x-text="v"></option>
                        </template>
                    </select>
                </label>
                <label class="grid gap-1 text-xs md:text-[13px] font-semibold text-gray-700">
                    <span>Tanggal Penjemputan</span>
                    <input type="date" x-model="tanggal" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                </label>
                <div class="flex items-end gap-2 col-span-2 lg:col-span-1 lg:justify-end">
                    <button type="button" @click="applyFilter()" class="inline-flex h-[42px] flex-1 lg:flex-none items-center justify-center gap-1.5 rounded-xl bg-dark-green px-5 text-xs font-bold text-white hover:brightness-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        Filter
                    </button>
                    <button type="button" @click="resetFilter()" x-show="applied" x-cloak
                            class="inline-flex h-[42px] items-center justify-center gap-1.5 rounded-xl border border-slate-200 bg-white px-4 text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                        Reset
                    </button>
                </div>
            </div>

            {{-- Kartu armada --}}
            <div id="armada" class="mt-4 scroll-mt-24">
                <div x-show="applied && visibleCount === 0" x-cloak
                     class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/60 p-6 text-center">
                    <p class="text-sm font-semibold text-slate-600">Tidak ada kendaraan yang cocok</p>
                    <p class="mt-1 text-xs text-slate-400">Coba ubah Pick Up / Drop Off atau jenis kendaraan.</p>
                    <button type="button" @click="resetFilter()" class="mt-3 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                        Reset Filter
                    </button>
                </div>
                <div class="space-y-3" x-show="visibleCount > 0">
                    @foreach($services as $i => $service)
                    <div x-show="showVehicle(@js($service->title))" x-cloak x-transition.opacity.duration.300ms>
                        @include('categories.partials.transport-card', [
                            'service' => $service,
                            'index' => $i,
                        ])
                    </div>
                    @endforeach
                </div>

                {{-- Pemicu form popup (mobile) --}}
                <button type="button" @click="openForm()"
                        class="mt-4 lg:hidden w-full flex items-center justify-center gap-2 bg-dark-green hover:brightness-110 text-white font-bold rounded-xl shadow-lg transition py-3 px-5 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    Isi Formulir Pemesanan
                </button>
            </div>
        </div>

        {{-- KOLOM KANAN: Kartu konsultasi — desktop sticky; mobile bottom-sheet popup --}}
        <div class="lg:hidden fixed inset-0 z-[70] bg-black/40 backdrop-blur-sm" x-show="formOpen" x-transition.opacity.duration.200ms @click="formOpen = false"></div>
        <div id="form-pesanan"
             class="min-w-0"
             :class="formOpen
                 ? 'fixed inset-0 z-[80] m-auto h-fit max-h-[85dvh] w-[calc(100%-1.5rem)] max-w-md overflow-y-auto rounded-2xl shadow-2xl lg:block lg:sticky lg:top-20 lg:inset-auto lg:z-auto lg:m-0 lg:h-auto lg:max-h-none lg:max-w-none lg:overflow-visible lg:shadow-sm'
                 : 'hidden lg:block lg:sticky lg:top-20'">
            <div class="relative rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <button type="button" @click="formOpen = false" aria-label="Tutup"
                        class="lg:hidden absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
                {{-- Header kartu: gradient + identitas kendaraan terpilih --}}
                <div class="bg-gradient-to-br from-emerald-50/80 via-white to-white px-4 sm:px-5 pt-4 sm:pt-5 pb-4 border-b border-slate-100">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-gold leading-none">Konsultasi Transportasi</p>
                    <div class="mt-3 flex items-center justify-between gap-3 rounded-xl border border-slate-100 bg-white px-3 py-2.5 shadow-sm" x-show="selected?.id" x-cloak>
                        <div class="min-w-0">
                            <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400 leading-none">Kendaraan</p>
                             <p class="mt-1 text-sm font-bold text-slate-950 truncate" x-text="selected?.title || 'Belum ada pilihan'"></p>
                        </div>
                        <div class="shrink-0 text-right">
                            <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400 leading-none" x-text="sidebarPriceLabel.label">Mulai Dari</p>
                            <p class="mt-1 text-sm font-bold tabular-nums text-dark-green leading-none" x-text="sidebarPriceLabel.text"></p>
                        </div>
                    </div>
                    {{-- Ringkasan rute & tanggal --}}
                    <div class="mt-2.5 space-y-1.5">
                        <div class="flex items-center gap-1.5 text-[11px] text-slate-500" x-show="pickup || dropoff" x-cloak>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0 text-gold"><path d="M5 22h14"/><path d="M5 2h14"/><path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/><path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/></svg>
                            <span x-text="pickup || '?'" class="font-medium"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0 text-emerald-500"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            <span x-text="dropoff || '?'" class="font-medium"></span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[11px] text-slate-500" x-show="tanggal" x-cloak>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0 text-gold"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <span class="font-medium">Penjemputan</span>
                            <span x-text="fmtDate(tanggal)"></span>
                        </div>
                        <p class="text-[11px] text-slate-400 leading-snug" x-show="!pickup && !dropoff" x-cloak>
                            Pilih rute &amp; kendaraan untuk melihat penawaran spesifik.
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('customer.store') }}"
                      x-data="{ loading: false, submitted: false }"
                      @submit.prevent="if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="service_id" :value="selected.id">
                    <input type="hidden" name="qty" :value="qty">
                    <input type="hidden" name="unit_price" :value="unitPrice ?? ''">
                    <input type="hidden" name="pickup" :value="pickup">
                    <input type="hidden" name="dropoff" :value="dropoff">
                    <input type="hidden" name="pickup_date" :value="tanggal">
                    <input type="hidden" name="item_title" :value="selected.title + ' - ' + (pickup || '?') + ' → ' + (dropoff || '?')">

                    <div class="p-4 sm:p-5 space-y-4">
                        {{-- Nama & WhatsApp berdampingan di mobile juga (hemat ruang) --}}
                        <div>
                            <label class="flex items-center gap-1 text-xs font-medium text-slate-700">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                                   class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 placeholder:text-slate-400 outline-none transition focus:border-gold/60 focus:ring-2 focus:ring-gold/20">
                        </div>
                        <div>
                            <label class="flex items-center gap-1 text-xs font-medium text-slate-700">
                                No WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="no_hp" required autocomplete="tel" placeholder="0812xxxxxxx"
                                   class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 placeholder:text-slate-400 outline-none transition focus:border-gold/60 focus:ring-2 focus:ring-gold/20">
                        </div>

                        {{-- Jumlah kendaraan --}}
                        <div>
                            <label class="flex items-center gap-1 text-xs font-medium text-slate-700">
                                Jumlah Kendaraan <span class="text-red-500">*</span>
                                <span class="text-[10px] text-slate-400 font-normal">(unit)</span>
                            </label>
                            <input type="number" x-model.number="qty" min="1" name="qty"
                                   class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 outline-none transition focus:border-gold/60 focus:ring-2 focus:ring-gold/20">
                        </div>

                        {{-- Ringkasan Harga --}}
                        <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-3 space-y-2" x-show="selected?.id" x-cloak>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Ringkasan Harga</p>
                            <div class="flex items-center justify-between text-xs text-slate-600">
                                <span>Harga per unit</span>
                                <span class="font-semibold tabular-nums" x-text="sidebarPriceLabel.text"></span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-600">
                                <span>Jumlah unit</span>
                                <span class="font-semibold tabular-nums" x-text="qty + ' unit'"></span>
                            </div>
                            <div class="pt-1.5 mt-1.5 border-t border-dashed border-slate-200 flex items-center justify-between">
                                <span class="text-xs font-semibold text-slate-700">Total</span>
                                <span class="text-base font-bold tabular-nums text-dark-green" x-text="totalLabel"></span>
                            </div>
                            <p class="text-[10px] text-slate-400 leading-tight">Estimasi harga untuk jumlah unit yang dipilih. Harga final dikonfirmasi via WhatsApp.</p>
                        </div>

                        <button type="submit" :disabled="loading || !selected?.id"
                                class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold rounded-xl shadow-lg shadow-[#25D366]/25 transition py-2.5 px-4 text-sm disabled:opacity-60">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            <span x-text="loading ? 'Mengirim...' : 'Kirim Request'">Kirim Request</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @else
    <div class="text-center py-10 card-glass-gold rounded-2xl p-6">
        <p class="text-gray-400 text-sm">Segera Hadir</p>
        <p class="text-gray-300 text-xs mt-1">Konten untuk kategori ini sedang dipersiapkan.</p>
    </div>
    @endif
</div>

@push('modals')
    @include('categories.partials.modal-consult')
@endpush
@endsection