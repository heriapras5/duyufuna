@props([
    'item' => null,
    'service' => null,
    'category' => null,
])

@php
    $item = $item ?? $card ?? null;
    $category = $category ?? $service?->category ?? null;
    $hasImage = $item->image && !str_ends_with($item->image, '.svg');
    $href = $item->slug
        ? route('detail.show', $item->slug)
        : route('category.service', [$category?->slug, $service?->slug]);
    $location = $item->location ?? 'Saudi Arabia';
    $desc = trim(strip_tags((string) $item->description));
    $desc = Str::limit($desc, 90);
@endphp

<article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm flex flex-col h-full transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-amber-200">
    <a href="{{ $href }}" class="relative block aspect-[16/10] bg-white overflow-hidden">
        @if($hasImage)
        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        @endif
        @if($category)
        <span class="absolute top-2.5 left-2.5 inline-flex items-center rounded-full bg-dark-green/90 text-white text-[10px] font-bold tracking-wide px-2.5 py-1 shadow-lg backdrop-blur">
            {{ $category->name }}
        </span>
        @endif
    </a>

    <div class="p-4 sm:p-5 flex-1 flex flex-col">
        <a href="{{ $href }}" class="block">
            <h3 class="font-serif text-sm md:text-[15px] font-bold leading-snug tracking-tight text-slate-950 line-clamp-2 break-words group-hover:text-dark-green transition-colors">{{ $item->title }}</h3>
        </a>
        @if($desc)
        <p class="mt-1.5 text-xs md:text-[13px] font-medium text-slate-700 leading-relaxed line-clamp-2">{{ $desc }}</p>
        @endif

        {{-- Harga --}}
        <div class="mt-3 pt-3 border-t border-dashed border-slate-200">
            <p class="text-[10px] md:text-[11px] font-bold uppercase tracking-[0.14em] text-dark-green leading-none">Harga</p>
            @if($item->priceLabelUSD())
            <p class="mt-1.5 text-sm md:text-[15px] font-extrabold tabular-nums tracking-tight text-dark-green leading-snug break-words">{{ $item->priceLabelUSD() }} <span class="text-[11px] font-semibold text-black">/ jamaah</span></p>
            @else
            <p class="mt-1.5 text-[13px] font-semibold text-slate-700 leading-tight break-words">Hubungi kami</p>
            @endif
        </div>

        {{-- Lokasi --}}
        <div class="mt-3 flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 shrink-0"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-[11px] md:text-xs font-semibold text-slate-700 break-words">{{ $location }}</span>
        </div>

        {{-- Tombol Detail + Hubungi --}}
        <div class="mt-auto pt-4 grid grid-cols-2 gap-2 items-stretch">
            <a href="{{ $href }}"
               class="inline-flex h-10 items-center justify-center gap-1.5 w-full rounded-xl bg-white border border-slate-200 px-2.5 text-[11px] md:text-xs font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 group-hover:shadow-md whitespace-nowrap">
                Detail
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 shrink-0"><path d="m9 18 6-6-6-6"/></svg>
            </a>
            <button type="button"
                    @click="$store.modal.setConsult({
                        service_id: {{ $service?->id ?? 'null' }},
                        item_id: @js($item->id),
                        item_title: @js($item->title),
                        title: @js($item->title),
                        unit_price: @js($item->price_per_night !== null ? (float) $item->price_per_night : null),
                        currency: 'US$',
                        unit_label: 'jamaah',
                    })"
                    class="inline-flex h-10 items-center justify-center gap-1 rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-[11px] md:text-xs font-semibold px-2.5 transition-all duration-300 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                <span class="truncate">Hubungi</span>
            </button>
        </div>
    </div>
</article>
