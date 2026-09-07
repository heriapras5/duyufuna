@props([
    'item' => null,
    'service' => null,
    'category' => null,
])

@php
    $item = $item ?? $card ?? null;
    $category = $category ?? $service?->category ?? null;
    $city = $service->title ?? $category->name ?? null;
    $href = $item->slug
        ? route('detail.show', $item->slug)
        : route('category.service', [$category?->slug, $service?->slug]);
    $hasImage = $item->image && !str_ends_with($item->image, '.svg');
    $roomTypes = array_filter(array_map('trim', explode(',', (string) $item->room_types)));
    $shortDesc = trim((string) ($item->tagline ?? ''))
        ?: trim(strip_tags((string) $item->description));
    $shortDesc = Str::limit($shortDesc, 100);
    
@endphp

<article class="group overflow-hidden rounded-2xl card-glass-gold">
    <div class="grid gap-3 sm:gap-4 p-3 sm:p-4 grid-cols-1 sm:grid-cols-[130px_minmax(0,1fr)] lg:grid-cols-[150px_minmax(0,1fr)_180px]">

        {{-- Baris atas: badge Hotel (kiri) + bintang (kanan) — semua layar --}}
        @if($item->star || $city)
        <div class="col-span-full flex items-center justify-between gap-2">
            @if($city)
            <span class="inline-flex items-center rounded-full bg-emerald-600 px-2.5 py-0.5 text-[11px] font-bold text-white shadow-sm truncate">
                Hotel {{ $city }}
            </span>
            @else
            <span></span>
            @endif
            @if($item->star)
            <span class="inline-flex items-center gap-0.5 select-none shrink-0" title="{{ $item->star }} dari 5 bintang">
                @for($i = 1; $i <= 5; $i++)
                <svg viewBox="0 0 24 24" class="size-3.5 {{ $i <= $item->star ? 'fill-amber-400' : 'fill-gray-300' }}"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                @endfor
            </span>
            @endif
        </div>
        @endif

        {{-- Mobile: Gambar penuh di atas (bersih, tanpa overlay) --}}
        <a href="{{ $href }}" class="relative flex aspect-[16/10] sm:aspect-[4/3] w-full items-center justify-center overflow-hidden rounded-xl bg-white order-1">
            @if($hasImage)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            @endif
        </a>

        {{-- Mobile: Teks di bawah gambar (judul, desc) --}}
        <div class="sm:hidden space-y-1.5 order-2">
            <h3 class="font-serif text-[17px] font-bold leading-snug tracking-tight text-gray-900 break-words">{{ $item->title }}</h3>
            @if($shortDesc)
            <p class="mt-1 text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $shortDesc }}</p>
            @endif
        </div>

        {{-- Kolom 2: Konten --}}
        <div class="min-w-0 flex flex-col order-3">
            <div class="hidden sm:flex flex-wrap items-start justify-between gap-2">
                <div class="min-w-0 flex-1">
                    <h3 class="mt-1.5 font-serif text-[15px] md:text-[17px] font-bold leading-snug tracking-tight text-gray-900 break-words">{{ $item->title }}</h3>
                    @if($shortDesc)
                    <p class="mt-1 text-xs md:text-[13px] text-gray-500 leading-relaxed line-clamp-2">{{ $shortDesc }}</p>
                    @endif
                </div>
            </div>

            {{-- Spesifikasi: label di atas (lebih besar), nilai di bawah — sama untuk mobile & desktop --}}
            <div class="mt-2.5 grid grid-cols-2 gap-1.5 sm:gap-2 sm:grid-cols-2">
                @if($item->area)
                <div class="flex flex-col gap-y-1 rounded-lg bg-gray-50 border border-gray-100 px-2.5 py-2 sm:rounded-xl sm:bg-white sm:border-gray-200 sm:shadow-sm sm:px-3">
                    <span class="shrink-0 text-[13px] md:text-sm font-bold text-gray-900 leading-tight">Area</span>
                    <p class="text-xs md:text-[13px] font-medium text-slate-700 leading-snug break-words">{{ $item->area }}</p>
                </div>
                @endif
                @if($item->distanceLabel())
                <div class="flex flex-col gap-y-1 rounded-lg bg-gray-50 border border-gray-100 px-2.5 py-2 sm:rounded-xl sm:bg-white sm:border-gray-200 sm:shadow-sm sm:px-3">
                    <span class="shrink-0 text-[13px] md:text-sm font-bold text-gray-900 leading-tight">Jarak</span>
                    <p class="text-xs md:text-[13px] font-medium text-slate-700 leading-snug break-words">{{ $item->distanceLabel() }}</p>
                </div>
                @endif
                @if($item->walk_time)
                <div class="flex flex-col gap-y-1 rounded-lg bg-gray-50 border border-gray-100 px-2.5 py-2 sm:rounded-xl sm:bg-white sm:border-gray-200 sm:shadow-sm sm:px-3">
                    <span class="shrink-0 text-[13px] md:text-sm font-bold text-gray-900 leading-tight">Jalan kaki</span>
                    <p class="text-xs md:text-[13px] font-medium text-slate-700 leading-snug break-words">{{ $item->walk_time }}</p>
                </div>
                @endif
                @if(count($roomTypes) > 0)
                <div class="col-span-2 sm:col-span-1 flex flex-col gap-y-1 rounded-lg bg-gray-50 border border-gray-100 px-2.5 py-2 sm:rounded-xl sm:bg-white sm:border-gray-200 sm:shadow-sm sm:px-3">
                    <span class="shrink-0 text-[13px] md:text-sm font-bold text-gray-900 leading-tight">Tipe Kamar</span>
                    <p class="text-xs md:text-[13px] font-medium text-slate-700 leading-snug break-words">{{ implode(', ', $roomTypes) }}</p>
                </div>
                @endif
            </div>

            @if($item->mapUrl())
            <div class="mt-3">
                <a href="{{ $item->mapUrl() }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1.5 rounded-xl bg-white px-3 py-1.5 text-[13px] font-semibold text-emerald-700 border border-gray-200 shadow-sm transition hover:bg-emerald-50 hover:border-emerald-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                    Lokasi Hotel
                </a>
            </div>
            @endif
        </div>

        {{-- Kolom 3: Harga + Tombol --}}
        <div class="flex flex-col justify-between gap-2.5 rounded-xl card-glass-gold p-3 sm:p-4 order-4 sm:col-span-2 lg:col-span-1">
            <div>
                @if($item->priceLabel())
                <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.16em] text-gold leading-none">Harga termurah</p>
                <p class="mt-1 text-[17px] md:text-lg font-bold tabular-nums tracking-tight text-dark-green leading-none break-words">{{ $item->priceLabel() }}</p>
                @else
                <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.16em] text-gold leading-none">Harga</p>
                <p class="mt-1 text-[13px] md:text-sm font-semibold text-slate-500 break-words leading-tight">Hubungi kami</p>
                @endif
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-1 gap-2">
                <a href="{{ $href }}"
                   class="inline-flex h-9 items-center justify-center gap-1.5 rounded-xl bg-white border border-slate-200 px-3 text-xs md:text-[13px] font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 hover:border-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="m9 18 6-6-6-6"/></svg>
                    Lihat Detail
                </a>
                <button type="button"
                        @click="$store.modal.setConsult({
                            service_id: {{ $service?->id ?? 'null' }},
                            item_id: {{ $item->id }},
                            item_title: @js('Hotel ' . $item->title),
                            title: @js('Hotel ' . $item->title),
                            unit_price: @js($item->price_per_night ?? null),
                            currency: 'SAR',
                            unit_label: 'kamar',
                            extra_note: @js($item->price_max !== null ? 'Rentang harga ' . $item->priceLabel() . ' (harga final menyesuaikan)' : null),
                        })"
                        class="inline-flex h-9 items-center justify-center gap-1.5 rounded-xl bg-dark-green px-3 text-xs md:text-[13px] font-semibold text-white transition hover:bg-masjid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                    Konsultasi
                </button>
            </div>
        </div>

    </div>
</article>
