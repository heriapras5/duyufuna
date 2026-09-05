@extends('layouts.admin')
@section('title', $service->title . ' - ' . $category->name)
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Kelola ' . Str::lower($category->itemLabel()) . ' untuk "' . $service->title . '"')
@section('content')
<div>
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <a href="{{ ($hasMultipleServices ?? false)
        ? route('admin.catalog.groups', $category)
        : route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.catalog.items.create', [$category, $service]) }}" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah {{ $category->itemLabel() }}
        </a>
        <a href="{{ route('admin.catalog.groups.edit', [$category, $service]) }}" class="btn btn-secondary btn-sm">Edit {{ $service->title }}</a>
    </div>
</div>

{{-- Daftar Item --}}
@if($service->serviceItems->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @foreach($service->serviceItems as $item)
    @if($category->isHandling())
    {{-- Kartu item handling: mengikuti kartu paket di halaman publik (ikon medali, tanpa gambar) --}}
    <div class="flex flex-col bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-emerald-100 transition group overflow-hidden">
        <div class="relative flex flex-col items-center pt-5 pb-4 px-5 border-b border-gray-100 bg-gradient-to-b from-emerald-50/50 to-white">
            <div class="absolute top-3 right-3">
                <x-admin.status-toggle resource="service_items" :id="$item->id" :checked="$item->status" />
            </div>
            @php
                $key = mb_strtolower(trim((string) $item->title));
                $medalStroke = str_contains($key, 'platinum') ? '#6366f1' : (str_contains($key, 'gold') ? '#d97706' : '#94a3b8');
                $tiersSorted = collect($item->paxPrices())->sortBy('min')->values();
                $startPrice = $tiersSorted->isNotEmpty() ? (float) $tiersSorted[0]['price'] : null;
            @endphp
            <svg viewBox="0 0 24 24" class="w-10 h-10 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="{{ $medalStroke }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7.21 15 2.66 7.14a2 2 0 0 1 .13-2.2L4.4 2.8A2 2 0 0 1 6 2h12a2 2 0 0 1 1.6.8l1.6 2.14a2 2 0 0 1 .14 2.2L16.79 15"/>
                <path d="M11 12 5.12 2.2"/><path d="m13 12 5.88-9.8"/><path d="M8 7h8"/>
                <circle cx="12" cy="17" r="5"/><path d="M12 18v-2h-.5"/>
            </svg>
            <h3 class="mt-2 font-bold text-gray-900 text-base">{{ $item->title }}</h3>
            @if($startPrice !== null)
            <p class="mt-1.5 text-[11px] text-gray-500 leading-none">Mulai</p>
            <p class="mt-1 text-lg font-extrabold text-slate-900 leading-none">${{ number_format($startPrice, 2) }} <span class="text-[11px] font-medium text-gray-400">/ Pax</span></p>
            @endif
        </div>

        <div class="p-5 flex flex-col flex-1">
            @if($item->tagline)
            <p class="text-[13px] text-slate-600 leading-snug">{{ $item->tagline }}</p>
            @endif
            @if(count($item->benefitList()) > 0)
            <div class="mt-3 pt-3 border-t border-dashed border-gray-100">
                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-dark-green/80 leading-none mb-1.5">Include</p>
                <ul class="space-y-1">
                    @foreach(array_slice($item->benefitList(), 0, 3) as $b)
                    <li class="flex items-start gap-1.5 text-xs text-gray-600 leading-snug">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 shrink-0 text-emerald-600"><path d="M20 6 9 17l-5-5"/></svg>
                        <span class="line-clamp-1">{{ $b }}</span>
                    </li>
                    @endforeach
                    @if(count($item->benefitList()) > 3)
                    <li class="text-[11px] text-gray-400">+{{ count($item->benefitList()) - 3 }} lainnya</li>
                    @endif
                </ul>
            </div>
            @endif
            @if($tiersSorted->isNotEmpty())
            <div class="mt-auto pt-3">
                <div class="rounded-xl border border-emerald-100 bg-emerald-50/60 overflow-hidden">
                    <p class="px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.14em] text-dark-green bg-emerald-100/60 border-b border-emerald-100 leading-none">Detail Harga</p>
                    <ul class="divide-y divide-emerald-100/70 px-3 py-1">
                        @foreach($tiersSorted as $t)
                        <li class="flex items-center justify-between py-1.5 text-xs tabular-nums">
                            <span class="text-gray-500">{{ $t['min'] }}–{{ $t['max'] }} Pax</span>
                            <span class="font-bold text-dark-green">${{ number_format($t['price'], 2) }}<span class="font-medium text-slate-400">/Pax</span></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-end gap-1">
                <a href="{{ route('admin.catalog.items.edit', $item) }}" title="Edit"
                   class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                </a>
                <button type="button" onclick="confirmDelete('{{ route('admin.catalog.items.destroy', $item) }}')" title="Hapus"
                        class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
            </div>
        </div>
    </div>
    @else
    <div class="flex flex-col bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-emerald-100 transition group overflow-hidden">
        <div class="relative h-36 bg-gray-50">
            @if($item->image)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute top-3 right-3">
                <x-admin.status-toggle resource="service_items" :id="$item->id" :checked="$item->status" />
            </div>
        </div>

        <div class="p-5 flex flex-col flex-1">
            <div class="flex items-center justify-between gap-2">
                <h3 class="font-bold text-gray-900 text-base truncate">{{ $item->title }}</h3>
                @if($item->star)
                <span class="shrink-0 inline-flex items-center gap-0.5 text-xs font-semibold text-amber-600 bg-amber-50 rounded-full px-2 py-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    {{ $item->star }}
                </span>
                @endif
            </div>
            @if($category->isHotel() && $item->price_per_night !== null)
            <p class="mt-1 text-xs font-semibold text-emerald-600">{{ $item->priceLabel() }} <span class="font-normal text-gray-400">/ malam</span></p>
            @elseif($category->slug === 'visa' && $item->price_per_night !== null)
            <p class="mt-1 text-xs font-semibold text-emerald-600">{{ $item->priceLabelUSD() }}</p>
            @elseif($category->slug === 'jastip-viral' && $item->price_per_night !== null)
            <p class="mt-1 text-xs font-semibold text-emerald-600">SAR {{ number_format((float) $item->price_per_night, 0, ',', '.') }}</p>
            @endif
            @if($item->description && !$category->isHandling())
            <div class="mt-1.5 pt-1.5 border-t border-gray-100 border-dashed">
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">{!! Str::limit(strip_tags($item->description), 140) !!}</p>
            </div>
            @endif
            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-end gap-1">
                <a href="{{ route('admin.catalog.items.edit', $item) }}" title="Edit"
                   class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                </a>
                <button type="button" onclick="confirmDelete('{{ route('admin.catalog.items.destroy', $item) }}')" title="Hapus"
                        class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@else
<x-admin.card>
    <div class="text-center py-8">
        <p class="text-sm font-semibold text-gray-500">Belum ada {{ Str::lower($category->itemLabel()) }}</p>
        <p class="text-xs text-gray-400 mt-1">Klik tombol <span class="font-semibold">Tambah {{ $category->itemLabel() }}</span> di pojok kanan atas untuk menambahkan yang pertama.</p>
    </div>
</x-admin.card>
@endif
</div>
@endsection
