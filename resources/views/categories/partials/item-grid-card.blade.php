@props([
    'item' => null,
    'service' => null,
    'category' => null,
    'index' => 0,
    'delay' => 0.03,
])

@php
    $item = $item ?? $card ?? null;
    $service = $service ?? $item?->service ?? null;
    $category = $category ?? $service?->category ?? null;
    $hasImage = $item->image && !str_ends_with($item->image, '.svg');
    $desc = Str::limit(trim(strip_tags((string) $item->description)), 80);

    // Harga: SAR (default); jastip tanpa akhiran "/paket"
    $isJastip = $category !== null && $category->slug === 'jastip-viral';
    if ($item->price_per_night !== null) {
        $priceLabel = 'SAR ' . number_format((float) $item->price_per_night, 0, ',', '.');
        $priceUnit = $isJastip ? '' : '/paket';
        $unitPrice = (float) $item->price_per_night;
        $currency = 'SAR';
        $unitLabel = $isJastip ? 'produk' : 'paket';
    } else {
        $priceLabel = null;
        $priceUnit = '';
        $unitPrice = null;
        $currency = 'SAR';
        $unitLabel = $isJastip ? 'produk' : 'paket';
    }
@endphp

<div class="group card-glass-gold rounded-2xl overflow-hidden flex flex-col h-full"
     style="animation: fadeIn 0.5s ease-out {{ $index * $delay }}s both;">
    <div class="relative aspect-[16/10] bg-white overflow-hidden">
        @if($hasImage)
        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        @endif
    </div>

    <div class="p-4 sm:p-5 flex-1 flex flex-col">
        <h3 class="text-[15px] sm:text-base font-bold text-slate-950 leading-snug line-clamp-2">{{ $item->title }}</h3>
        @if($desc)
        <p class="mt-1 text-[13px] font-medium text-slate-700 leading-relaxed line-clamp-2">{{ $desc }}</p>
        @endif

        {{-- Harga --}}
        @if($priceLabel)
        <div class="mt-2.5 pt-2.5 border-t border-dashed border-gray-100">
            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-dark-green/80 leading-none">Harga</p>
            <p class="mt-1 text-base sm:text-lg font-extrabold tabular-nums tracking-tight text-dark-green leading-none">
                {{ $priceLabel }}
                @if($priceUnit)<span class="text-xs font-semibold text-slate-700"> {{ $priceUnit }}</span>@endif
            </p>
        </div>
        @endif

        {{-- Tombol --}}
        <div class="mt-auto pt-3 grid grid-cols-2 gap-2">
            <button type="button"
                    @click="$store.modal.setDetail({
                        service_id: {{ $service?->id ?? 'null' }},
                        item_id: @js($item->id),
                        item_title: @js($item->title),
                        image: @js($hasImage ? Storage::url($item->image) : null),
                        title: @js($item->title),
                        description: @js($item->description),
                        unit_price: @js($unitPrice),
                        currency: @js($currency),
                        unit_label: @js($unitLabel),
                    })"
                    class="inline-flex h-9 items-center justify-center gap-1 w-full rounded-xl bg-white border border-slate-200 px-2.5 text-xs sm:text-[13px] font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><path d="m9 18 6-6-6-6"/></svg>
                <span class="truncate">Detail</span>
            </button>
            <button type="button"
                    @click="$store.modal.setConsult({
                        service_id: {{ $service?->id ?? 'null' }},
                        item_id: @js($item->id),
                        item_title: @js($item->title),
                        title: @js($item->title),
                        unit_price: @js($unitPrice),
                        currency: @js($currency),
                        unit_label: @js($unitLabel),
                    })"
                    class="inline-flex h-9 items-center justify-center gap-1 rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-xs sm:text-[13px] font-semibold px-2.5 transition-all duration-300 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                <span class="truncate">Hubungi</span>
            </button>
        </div>
    </div>
</div>
