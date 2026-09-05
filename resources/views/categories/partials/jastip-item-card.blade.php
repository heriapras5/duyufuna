@props([
    'item' => null,
    'service' => null,
    'category' => null,
])

@php
    $item = $item ?? $card ?? null;
    $service = $service ?? $item->service ?? null;
    $category = $category ?? $service?->category ?? null;
    $hasImage = $item->image && !str_ends_with($item->image, '.svg');
    $price = $item->price_per_night !== null ? (float) $item->price_per_night : null;
@endphp

<button type="button"
        @click="selectItem({{ $item->id }}, {{ $service?->id ?? 'null' }}, @js($item->title), {{ $price ?? 'null' }})"
        class="group relative w-full rounded-2xl bg-white border-2 p-2.5 sm:p-3 text-left transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 focus:outline-none cursor-pointer overflow-hidden"
        :class="selectedId === {{ $item->id }} ? 'border-emerald-600 ring-2 ring-emerald-500/25' : 'border-gray-100 hover:border-emerald-500/60'">
    <div class="flex gap-2.5 sm:gap-3">
        {{-- Gambar --}}
        <div class="relative w-[96px] sm:w-[128px] aspect-[4/3] rounded-xl overflow-hidden bg-white shrink-0">
            @if($hasImage)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent pointer-events-none"></div>
            @endif
            <div x-show="selectedId === {{ $item->id }}" x-cloak
                 class="absolute top-1.5 right-1.5 inline-flex items-center gap-1 rounded-full bg-emerald-600 text-white text-[9px] font-bold px-2 py-0.5 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                Dipilih
            </div>
        </div>

        {{-- Konten --}}
        <div class="min-w-0 flex-1 text-left">
            @if($service)
            <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-gold/90 leading-none">{{ $service->title }}</p>
            @endif
            <h3 class="mt-1 font-serif text-[15px] md:text-[17px] font-bold leading-snug tracking-tight text-gray-900 break-words">{{ $item->title }}</h3>

            @if($item->description)
            <p class="mt-1 text-xs md:text-[13px] text-gray-500 leading-relaxed line-clamp-2">{{ Str::limit(strip_tags((string) $item->description), 90) }}</p>
            @endif

            @if($price)
            <p class="mt-2 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.16em] text-gold leading-none">Harga</p>
            <p class="mt-0.5 text-[15px] md:text-base font-bold tabular-nums tracking-tight text-dark-green leading-none">
                SAR {{ number_format($price, 0, ',', '.') }}
            </p>
            @else
            <p class="mt-2 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.16em] text-gold leading-none">Harga</p>
            <p class="mt-0.5 text-[13px] md:text-sm font-semibold text-slate-500 leading-none">Hubungi kami</p>
            @endif
        </div>
    </div>
</button>
