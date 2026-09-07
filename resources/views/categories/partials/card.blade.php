@props([
    'card' => null,
    'service' => null,
    'title' => null,
    'description' => null,
    'image' => null,
    'variant' => 0,
    'subtext' => null,
])

@php
    $title = $title ?? ($card->title ?? '');
    $description = $description ?? ($card->description ?? '');
    $image = $image ?? ($card->image ?? null);
    $popupDesc = ($card->short_description && trim((string) $card->short_description) !== '')
        ? $card->short_description
        : $description;
    $item_id = $card instanceof \App\Models\ServiceItem ? $card->id : null;
    $hasImage = $image && !str_ends_with($image, '.svg');
    $cardSlug = $card->slug ?? null;
    $detailHref = $cardSlug
        ? ($card instanceof \App\Models\ServiceItem
            ? route('detail.show', $cardSlug)
            : route('service.detail', $cardSlug))
        : null;
@endphp

<div class="group card-glass-gold rounded-2xl overflow-hidden flex flex-col h-full">
    <div class="relative aspect-[16/10] bg-white overflow-hidden flex items-center justify-center">
        @if($image && !str_ends_with($image, '.svg'))
        <img src="{{ Storage::url($image) }}" alt="{{ $title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        @endif
    </div>
    <div class="px-4 pt-3 pb-4 md:px-5 md:pt-4 md:pb-5 flex-1 flex flex-col">
        <h3 class="text-sm md:text-base font-bold text-gray-900 leading-tight line-clamp-2">{{ $title }}</h3>
        @if($description)
        <div class="mt-2 pt-2 border-t border-gray-100 border-dashed">
            <p class="text-xs md:text-[13px] text-gray-500 leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($description), 130) }}</p>
        </div>
        @endif
        @if(($service->price ?? null) || ($card->price_per_night ?? null))
        <div class="mt-2.5 pt-2.5 border-t border-gray-100 border-dashed">
            <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em] text-gold/80 leading-none">Harga</p>
            @if($service->price ?? null)
            <p class="mt-1 text-[15px] md:text-base font-bold tabular-nums tracking-tight text-dark-green leading-none">Rp {{ number_format((float) $service->price, 0, ',', '.') }}</p>
            @else
            <p class="mt-1 text-[15px] md:text-base font-bold tabular-nums tracking-tight text-dark-green leading-none">Rp {{ number_format((float) $card->price_per_night, 0, ',', '.') }}</p>
            @endif
        </div>
        @endif
        <div class="mt-auto pt-3.5 grid grid-cols-1 sm:grid-cols-2 gap-2">
            @if($detailHref)
            <a href="{{ $detailHref }}"
               class="inline-flex h-9 items-center justify-center gap-1 w-full rounded-xl bg-white border border-slate-200 px-2.5 text-xs md:text-[13px] font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><path d="m9 18 6-6-6-6"/></svg>
                <span class="truncate">Lihat Detail</span>
            </a>
            @else
            <button type="button"
                    @click="$store.modal.setDetail({
                        service_id: {{ $service->id }},
                        item_title: @js($title),
                        image: @js($hasImage ? Storage::url($image) : null),
                        title: @js($title),
                        description: @js($popupDesc),
                    })"
                    class="inline-flex h-9 items-center justify-center gap-1 w-full rounded-xl bg-white border border-slate-200 px-2.5 text-xs md:text-[13px] font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><path d="m9 18 6-6-6-6"/></svg>
                <span class="truncate">Lihat Detail</span>
            </button>
            @endif
            <button type="button"
                    @click="$store.modal.setConsult({
                        service_id: {{ $service->id }},
                        item_id: @js($item_id),
                        item_title: @js($title),
                        title: @js($title),
                        unit_price: @js($card->price_per_night ?? null),
                        currency: 'SAR',
                        unit_label: 'item',
                    })"
                    class="inline-flex h-9 items-center justify-center gap-1 rounded-xl bg-dark-green hover:bg-masjid text-white text-xs md:text-[13px] font-semibold px-2.5 transition-all duration-300 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 shrink-0"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                <span class="truncate">Konsultasi</span>
            </button>
        </div>
    </div>
</div>