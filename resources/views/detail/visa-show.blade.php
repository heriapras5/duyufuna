@extends('layouts.public')

@section('title', 'Detail ' . ($category->name ?? 'Visa') . ' - ' . $item->title)
@section('meta_description', Str::limit(strip_tags($item->description ?? ''), 160) ?: ('Detail ' . ($category->name ?? '') . ' - ' . $item->title))
@section('seo_keywords', $category?->meta_keywords)
@section('og_image', $item->image)

@section('no_hero', true)

@php
    $image = $item->image ?? null;
    $benefits = $item->benefitList();
@endphp

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 md:pt-6 lg:pt-8 pb-10 max-w-7xl mx-auto" x-data="">

    {{-- Kembali + Judul (selalu di atas, full-width) --}}
    <div class="flex items-center gap-3 sm:gap-4 mb-5 sm:mb-6">
        <a href="{{ route('category.show', $category?->slug) }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition shrink-0 border border-gray-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>

        <div class="min-w-0 flex-1 self-center">
            <h1 class="font-sans text-base sm:text-lg md:text-xl font-semibold leading-tight tracking-[-0.01em] text-slate-900 break-words">{{ $item->title }}</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1.4fr_0.6fr] gap-6 md:gap-8 items-start">
        {{-- Kiri: Gambar + Deskripsi + Kelebihan + Keterangan --}}
        <div class="space-y-5 sm:space-y-6 min-w-0">

            {{-- Single Image — lebih pendek dari card (16/10) --}}
            @if($image && !str_ends_with($image, '.svg'))
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="relative aspect-[16/8] sm:aspect-[21/9] max-h-[320px] sm:max-h-[380px] w-full overflow-hidden bg-white">
                    <img src="{{ Storage::url($image) }}" alt="{{ $item->title }}"
                         class="w-full h-full object-cover">
                    @if($category)
                    <span class="absolute top-2.5 left-2.5 inline-flex items-center rounded-full bg-dark-green/90 text-white text-[10px] font-bold tracking-wide px-2.5 py-1 shadow-lg backdrop-blur">
                        {{ $category->name }}
                    </span>
                    @endif
                </div>
            </div>
            @endif

            {{-- Deskripsi --}}
            @if($item->description && trim(strip_tags((string) $item->description)) !== '')
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 md:p-7 shadow-sm">
                <h2 class="text-sm sm:text-[15px] font-semibold tracking-[-0.01em] text-gray-900 mb-3 sm:mb-4">Deskripsi</h2>
                <div class="article-content text-[13px] sm:text-[15px] leading-7 text-slate-600">
                    {!! $item->description !!}
                </div>
            </div>
            @endif

            {{-- CTA Hubungi (mobile saja, popup form) --}}
            <div class="lg:hidden">
                <button type="button"
                        @click="$store.modal.setConsult({ service_id: {{ $service?->id ?? 'null' }}, item_id: @js($item->id), item_title: @js($item->title), title: @js($item->title), unit_price: @js($item->price_per_night !== null ? (float) $item->price_per_night : null), currency: 'US$', unit_label: 'jamaah' })"
                        class="w-full inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-sm font-bold shadow-lg shadow-[#25D366]/25 active:scale-[0.98] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 shrink-0"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    Hubungi
                </button>
            </div>

            {{-- Kelebihan (list bercentang) --}}
            @if(count($benefits) > 0)
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 md:p-7 shadow-sm">
                <h2 class="text-sm sm:text-[15px] font-semibold tracking-[-0.01em] text-gray-900 mb-3 sm:mb-4">Kelebihan</h2>
                <ul class="checklist-content grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2.5">
                    @foreach($benefits as $b)
                    <li class="relative text-[13px] sm:text-sm leading-6 text-gray-700">{{ $b }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Keterangan (konten HTML dari admin) --}}
            @if($item->recommendation)
            <div class="rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50/70 to-white p-4 sm:p-5 md:p-7 shadow-sm">
                <h2 class="flex items-center gap-2.5 text-sm sm:text-[15px] font-semibold tracking-[-0.01em] text-gray-900 mb-3.5">
                    <span class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0 border border-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3L12 3Z"/></svg>
                    </span>
                    Keterangan
                </h2>
                <div class="article-content text-[13px] sm:text-[15px] leading-7 text-slate-600">
                    {!! $item->recommendation !!}
                </div>
            </div>
            @endif
        </div>

        {{-- Kanan: Estimasi Harga + Form Data Pesanan (desktop saja; mobile disembunyikan) --}}
        <div id="form-pesanan" class="hidden lg:block lg:sticky lg:top-20 h-fit min-w-0 scroll-mt-20 lg:scroll-mt-24">
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                {{-- Estimasi --}}
                <div class="px-4 sm:px-5 md:px-6 pt-5 sm:pt-6 pb-4 sm:pb-5 border-b border-slate-100 bg-slate-50">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">Estimasi Harga</p>
                    @if($item->priceLabelUSD())
                    <p class="mt-2 text-[18px] sm:text-xl font-bold tabular-nums tracking-tight text-dark-green leading-none break-words">{{ $item->priceLabelUSD() }}</p>
                    @else
                    <p class="mt-1.5 text-sm leading-6 text-slate-500">Hubungi kami untuk informasi harga terbaru</p>
                    @endif
                </div>

                {{-- Form Data Pesanan --}}
                <div class="px-4 sm:px-5 md:px-6 py-5 sm:py-6 md:py-7">
                    <form method="POST" action="{{ route('customer.store') }}"
                          x-data="{ loading: false, submitted: false }"
                          @submit.prevent="if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category?->id }}">
                        <input type="hidden" name="service_id" value="{{ $service?->id }}">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="item_title" value="{{ $item->title }}">
                        @if($item->priceLabelUSD())
                        <input type="hidden" name="unit_price" value="{{ (float) $item->price_per_night }}">
                        <input type="hidden" name="currency" value="US$">
                        <input type="hidden" name="unit_label" value="jamaah">
                        @endif

                        <p class="font-sans text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Form Data Pesanan</p>

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
                                        class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold rounded-full shadow-lg shadow-[#25D366]/25 hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 py-2.5 px-4 text-[13px] sm:text-sm">
                                    <span x-show="!loading" class="flex items-center justify-center gap-1.5 sm:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white" class="w-4 h-4 sm:w-5 sm:h-5"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                        Hubungi
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
        </div>
    </div>
</div>
@push('modals')
    @include('categories.partials.modal-consult')
@endpush
@endsection