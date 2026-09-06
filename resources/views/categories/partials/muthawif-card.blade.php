@props([
    'item' => null,
    'service' => null,
    'category' => null,
])

@php
    $item = $item ?? $card ?? null;
    $category = $category ?? $service?->category ?? null;
    $hasImage = $item->image && !str_ends_with($item->image, '.svg');
    $price = $item->price_per_night !== null ? (float) $item->price_per_night : null;
    $priceSuffix = ($category?->slug ?? '') === 'muthawif' ? '/ hari' : '';
@endphp

<button type="button"
        @click="selectItem({{ $item->id }}, {{ $service?->id ?? 'null' }}, @js($item->title), {{ $price ?? 'null' }}, @js($item->info))"
        class="group relative w-full rounded-2xl bg-white border-2 p-2.5 sm:p-3 text-left transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 focus:outline-none cursor-pointer overflow-hidden"
        :class="selectedId === {{ $item->id }} ? 'border-emerald-600 ring-2 ring-emerald-500/25' : 'border-gray-100 hover:border-emerald-500/60'">
    <div x-show="selectedId === {{ $item->id }}" x-cloak
         class="absolute top-2 right-2 z-10 inline-flex items-center gap-1 rounded-full bg-emerald-600 text-white text-[9px] font-bold px-2 py-0.5 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
        Dipilih
    </div>
    <div class="flex gap-2.5 sm:gap-3">
        {{-- Gambar --}}
        <div class="relative w-[96px] sm:w-[128px] aspect-[4/3] rounded-xl overflow-hidden bg-white shrink-0">
            @if($hasImage)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent pointer-events-none"></div>
            @endif
        </div>

        {{-- Konten --}}
        <div class="min-w-0 flex-1 text-left">
            @if($category)
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-dark-green/80 leading-none">{{ $category->name }}</p>
            @endif
            <h3 class="mt-1 font-serif text-base md:text-lg font-bold leading-snug tracking-tight text-slate-950 break-words">{{ $item->title }}</h3>

            @if($item->info)
            <p class="mt-1 text-[13px] md:text-sm font-medium text-slate-700 leading-relaxed">{{ $item->info }}</p>
            @endif

            @if($price)
            <p class="mt-2 text-base md:text-lg font-extrabold tabular-nums tracking-tight text-dark-green leading-none">
                SAR {{ number_format($price, 0, ',', '.') }}@if($priceSuffix) <span class="text-xs font-semibold text-slate-700">{{ $priceSuffix }}</span>@endif
            </p>
            @else
            <p class="mt-2 text-[13px] md:text-sm font-semibold text-slate-700 leading-none">Hubungi kami</p>
            @endif

            {{-- Tombol Pilih Muthawif (mobile saja, pojok kanan bawah kartu) --}}
            <div class="mt-2 flex justify-end lg:hidden">
                <span role="button" tabindex="0"
                      @click.stop="selectItem({{ $item->id }}, {{ $service?->id ?? 'null' }}, @js($item->title), {{ $price ?? 'null' }}, @js($item->info))"
                      class="inline-flex h-9 items-center rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-xs font-bold px-4 shadow-lg shadow-[#25D366]/25 active:scale-[0.98] transition-all whitespace-nowrap">
                    Pilih Muthawif
                </span>
            </div>
        </div>
    </div>
</button>