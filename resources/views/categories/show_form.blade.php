@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)
@section('og_image', $services->first()?->image)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@php
    $isGridCard = in_array($category->slug, ['buggy-car', 'kursi-roda-umroh']);
@endphp

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-5 pb-10 md:pt-6 md:pb-12 max-w-7xl mx-auto space-y-4 sm:space-y-6">
    <div class="flex items-center gap-3 sm:gap-4">
        <a href="{{ route('home') }}" class="w-7 h-7 md:w-8 md:h-8 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition shrink-0 border border-slate-200/60 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="min-w-0">
            <h1 class="font-serif text-base sm:text-lg md:text-xl font-bold text-gray-900 leading-tight break-words">{{ $category->name }}</h1>
            @if($category->subtitle)
            <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
            @endif
        </div>
    </div>

    @if($items->count() > 0)
    <section class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_340px] gap-3 sm:gap-4 items-start"
             x-data="{
                 selectedId: null,
                 selectedServiceId: null,
                 selectedTitle: '',
                 selectedPrice: null,
                 selectedInfo: '',
                 serviceTitle: {{ \Illuminate\Support\Js::from($services->first()?->title ?? '') }},
                 days: 0,
                 laundryDate: '',
                 laundryTime: '',
                 formOpen: false,
                 loading: false,
                 submitted: false,
                 init() {
                     this.$watch('formOpen', (value) => {
                         document.body.classList.toggle('modal-body-lock', value);
                         this.$dispatch('hide-bottom-nav', value);
                     });
                 },
                 selectItem(id, serviceId, title, price, info) {
                     this.selectedId = id;
                     this.selectedServiceId = serviceId;
                     this.selectedTitle = title;
                     this.selectedPrice = price;
                     this.selectedInfo = info || '';
                     if (window.innerWidth < 1024) this.formOpen = true;
                 },
                 fmtDate(d) {
                     if (!d) return '';
                     const dt = new Date(d + 'T00:00:00');
                     if (isNaN(dt.getTime())) return d;
                     const p = (n) => String(n).padStart(2, '0');
                     return p(dt.getDate()) + '/' + p(dt.getMonth() + 1) + '/' + dt.getFullYear();
                 },
                 openPicker(refName) {
                     const el = this.$refs[refName];
                     if (!el) return;
                     try { el.showPicker(); } catch (e) { el.focus(); }
                 },
             }">
        {{-- Kolom kiri: daftar kartu muthawif (selektabel) --}}
        <div class="min-w-0">
            <div class="rounded-2xl bg-white border border-gray-100 shadow-sm overflow-hidden">
                @if(!in_array($category->slug, ['laundry', 'buggy-car', 'kursi-roda-umroh']))
                <div class="px-4 md:px-5 pt-4 pb-3 border-b border-dashed border-gray-100 bg-gradient-to-br from-emerald-50/60 to-white">
                    <h2 class="font-serif text-sm md:text-base font-bold text-gray-900 leading-tight">Pilih {{ $category->itemLabel() }}</h2>
                </div>
                @endif
                <div class="p-3 sm:p-4 md:p-5 bg-slate-50/40 @if($isGridCard || $category->slug === 'laundry') grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 @else space-y-3 sm:space-y-4 @endif">
                    @foreach($items as $item)
                    @if($isGridCard)
                    @include('categories.partials.buggy-card', [
                        'item' => $item,
                        'service' => $item->service,
                        'category' => $category,
                        'index' => $loop->index,
                    ])
                    @elseif($category->slug === 'laundry')
                    @include('categories.partials.laundry-card', [
                        'item' => $item,
                        'service' => $item->service,
                        'category' => $category,
                        'index' => $loop->index,
                    ])
                    @else
                    @include('categories.partials.muthawif-card', [
                        'item' => $item,
                        'service' => $item->service,
                        'category' => $category,
                    ])
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Kolom kanan: form (desktop: sidebar sticky; mobile: bottom-sheet popup) --}}
        <div class="lg:hidden fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm" x-show="formOpen" x-transition.opacity.duration.200ms @click="formOpen = false"></div>
        <aside class="lg:w-full"
               :class="formOpen
                   ? 'fixed inset-0 z-[70] m-auto h-fit max-h-[85dvh] w-[calc(100%-1.5rem)] max-w-md overflow-y-auto rounded-2xl shadow-2xl lg:sticky lg:top-24 lg:inset-auto lg:z-auto lg:m-0 lg:h-auto lg:max-h-none lg:max-w-none lg:overflow-visible lg:shadow-sm'
                   : 'hidden lg:block lg:sticky lg:top-24'">
            <div class="bg-white border border-gray-100 shadow-sm overflow-hidden rounded-2xl">
                <div class="px-4 sm:px-5 pt-5 pb-4 border-b border-dashed border-gray-100 bg-gradient-to-br from-emerald-50/60 to-white flex items-start justify-between gap-3">
                    <div>
                        <h2 class="font-serif text-sm md:text-base font-bold text-gray-900 leading-tight">Konsultasi {{ $category->name }}</h2>
                        <p class="text-[11px] md:text-xs text-gray-600 mt-0.5">Isi data Anda, request akan dikirim via WhatsApp.</p>
                    </div>
                    <button type="button" @click="formOpen = false" aria-label="Tutup"
                            class="lg:hidden w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>

                {{-- Ringkasan pilihan (kategori lain; muthawif & laundry punya kartu sendiri di dalam form) --}}
                @if(!in_array($category->slug, ['muthawif', 'laundry']))
                <div class="px-4 sm:px-5 pt-4" x-show="selectedId" x-cloak>
                    <div class="rounded-xl border border-gold/25 bg-amber-50/50 p-3.5 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-gold/10 flex items-center justify-center text-gold shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                            <div class="min-w-0 flex-1">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-gold leading-none">{{ $category->itemLabel() }} dipilih</p>
                            <p class="mt-1 text-sm font-bold text-gray-900 leading-tight" x-text="selectedTitle"></p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="px-4 sm:px-5 py-4 sm:py-5">
                    <form method="POST" action="{{ route('customer.store') }}"
                          @submit.prevent="if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <input type="hidden" name="service_id" :value="selectedServiceId">
                        <input type="hidden" name="item_id" :value="selectedId">
                        @if($category->slug === 'muthawif')
                        <input type="hidden" name="item_title" :value="'Muthawif ' + selectedTitle">
                        @elseif(in_array($category->slug, ['buggy-car', 'kursi-roda-umroh']))
                        <input type="hidden" name="item_title" :value="serviceTitle ? selectedTitle + ' — ' + serviceTitle : selectedTitle">
                        @else
                        <input type="hidden" name="item_title" :value="selectedTitle">
                        @endif
                        @if($category->slug === 'muthawif')
                        <input type="hidden" name="qty" :value="days >= 1 ? days : ''">
                        <input type="hidden" name="unit_price" :value="selectedPrice ?? ''">
                        <input type="hidden" name="unit_label" value="hari">
                        @elseif($category->slug === 'laundry')
                        <input type="hidden" name="unit_price" :value="selectedPrice ?? ''">
                        <input type="hidden" name="unit_label" value="paket">
                        @else
                        <input type="hidden" name="unit_price" :value="selectedPrice ?? ''">
                        <input type="hidden" name="unit_label" value="{{ strtolower($category->itemLabel()) }}">
                        @endif

                        <div class="space-y-4">
                            @if($category->slug === 'laundry')
                            <div>
                                <label class="block text-[13px] font-semibold text-gray-800 mb-1">Tanggal Laundry</label>
                                <input type="hidden" name="pickup_date" :value="laundryDate">
                                <input type="hidden" name="pickup_time" :value="laundryTime">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300 z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        </div>
                                        <button type="button" @click="openPicker('laundryDateInput')" aria-label="Tanggal"
                                                class="w-full flex items-center pl-10 pr-2 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition text-left"
                                                :class="laundryDate ? 'text-gray-900' : 'text-gray-400'">
                                            <span x-text="laundryDate ? fmtDate(laundryDate) : 'dd/mm/yyyy'"></span>
                                        </button>
                                        <input type="date" x-ref="laundryDateInput" x-model="laundryDate" min="{{ now()->toDateString() }}" aria-label="Tanggal" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300 z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        </div>
                                        <button type="button" @click="openPicker('laundryTimeInput')" aria-label="Jam"
                                                class="w-full flex items-center pl-10 pr-2 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition text-left"
                                                :class="laundryTime ? 'text-gray-900' : 'text-gray-400'">
                                            <span x-text="laundryTime ? laundryTime : 'hh:mm'"></span>
                                        </button>
                                        <input type="time" x-ref="laundryTimeInput" x-model="laundryTime" aria-label="Jam" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div>
                                <label class="block text-[13px] font-semibold text-gray-800 mb-1">Nama <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                    <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[13px] font-semibold text-gray-800 mb-1">No WhatsApp <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    </div>
                                    <input type="tel" name="no_hp" required autocomplete="tel"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                                           placeholder="0812xxxxxxx">
                                </div>
                            </div>

                            @if($category->slug === 'muthawif')
                            {{-- Ringkasan pilihan & kalkulasi hari --}}
                            <div class="rounded-xl border border-emerald-200 bg-emerald-50/60 p-3.5 space-y-2.5" x-show="selectedId" x-cloak>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    </div>
                                    <p class="min-w-0 flex-1 text-xs font-bold text-gray-900 leading-relaxed">
                                        <input type="number" x-model.number="days" min="0" max="365" inputmode="numeric" aria-label="Jumlah hari"
                                               class="w-11 h-6 align-middle rounded-md border border-emerald-200 bg-white px-1 text-center text-xs font-bold tabular-nums text-gray-900 outline-none focus:border-emerald-500 [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                        <span class="mx-1">hari ×</span><span x-text="selectedTitle"></span>
                                    </p>
                                </div>
                                <div class="flex items-center justify-between gap-2 pt-2 border-t border-dashed border-emerald-200">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-emerald-700 leading-none">Total</p>
                                    <p class="text-base font-extrabold tabular-nums tracking-tight text-dark-green leading-none"
                                       x-text="selectedPrice && days >= 1 ? 'SAR ' + new Intl.NumberFormat('id-ID').format(Math.round(selectedPrice * days)) : 'SAR —'"></p>
                                </div>
                                <p class="text-[11px] text-gray-500 leading-snug" x-show="selectedPrice" x-cloak>
                                    Harga aktif: <span class="font-bold text-gray-700" x-text="'SAR ' + new Intl.NumberFormat('id-ID').format(Math.round(selectedPrice)) + ' / hari'"></span>
                                </p>
                            </div>
                            @endif

                            @if($category->slug === 'laundry')
                            {{-- Ringkasan paket terpilih --}}
                            <div class="rounded-xl border border-emerald-200 bg-emerald-50/60 p-4 space-y-3" x-show="selectedId" x-cloak>
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-emerald-700 leading-none">Paket dipilih</p>
                                        <p class="mt-1 text-sm font-bold text-gray-900 leading-snug break-words" x-text="selectedTitle"></p>
                                        <p class="mt-0.5 text-[11px] text-gray-500 leading-snug break-words" x-show="selectedInfo" x-cloak x-text="selectedInfo"></p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-2 pt-2.5 border-t border-dashed border-emerald-200">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-emerald-700 leading-none">Harga</p>
                                    <p class="text-base font-extrabold tabular-nums tracking-tight text-dark-green leading-none"
                                       x-text="selectedPrice ? 'SAR ' + new Intl.NumberFormat('id-ID').format(Math.round(selectedPrice)) : 'Hubungi kami'"></p>
                                </div>
                            </div>
                            @endif

                            @if(in_array($category->slug, ['buggy-car', 'kursi-roda-umroh']))
                            {{-- Ringkasan paket terpilih --}}
                            <div class="rounded-xl border border-emerald-200 bg-emerald-50/60 p-4 space-y-3" x-show="selectedId" x-cloak>
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/><path d="M5 17h2"/><path d="M17 17h2"/><path d="M2 12h2l3-4h10l3 4h2"/><path d="M9 8h6"/><path d="M3 14h18"/></svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-emerald-700 leading-none">Paket dipilih</p>
                                        <p class="mt-1 text-sm font-bold text-gray-900 leading-snug break-words" x-text="selectedTitle"></p>
                                        <p class="mt-0.5 text-[11px] text-gray-500 leading-snug break-words" x-show="selectedInfo" x-cloak x-text="selectedInfo"></p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-2 pt-2.5 border-t border-dashed border-emerald-200">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-emerald-700 leading-none">Harga</p>
                                    <p class="text-base font-extrabold tabular-nums tracking-tight text-dark-green leading-none"
                                       x-text="selectedPrice ? 'SAR ' + new Intl.NumberFormat('id-ID').format(Math.round(selectedPrice)) : 'Hubungi kami'"></p>
                                </div>
                            </div>
                            @endif

                            <div class="pt-2">
                                <button type="submit" :disabled="loading || !selectedId"
                                        class="w-full flex items-center justify-center gap-2 bg-dark-green hover:bg-masjid text-white font-bold rounded-full shadow-lg shadow-dark-green/25 hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 py-3 px-5 text-sm disabled:opacity-60 disabled:saturate-50">
                                    <span x-show="!loading" class="flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                        Kirim Request
                                    </span>
                                    <span x-show="loading" class="flex items-center justify-center gap-2">
                                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                                        Memproses...
                                    </span>
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 text-center leading-relaxed">Dengan mengirim, Anda menyetujui bahwa data Anda akan digunakan untuk keperluan konsultasi sesuai <a href="#" class="text-gold hover:text-amber-500">Kebijakan Privasi</a> kami.</p>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
    </section>
    @else
    <div class="text-center py-10 card-glass-gold rounded-2xl p-6">
        <p class="text-gray-400 text-sm">Segera Hadir</p>
        <p class="text-gray-300 text-xs mt-1">Pilihan {{ strtolower($category->itemLabel()) }} sedang dipersiapkan.</p>
    </div>
    @endif

</div>

@push('modals')
    @include('categories.partials.modal-consult')
@endpush
@endsection
