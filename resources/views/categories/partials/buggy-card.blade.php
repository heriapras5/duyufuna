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
    $price = $item->price_per_night !== null ? (float) $item->price_per_night : null;
@endphp

<button type="button"
        @click="selectItem({{ $item->id }}, {{ $service?->id ?? 'null' }}, @js($item->title), {{ $price ?? 'null' }}, @js($item->info))"
        class="group relative w-full rounded-2xl bg-white border-2 text-left transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 focus:outline-none cursor-pointer overflow-hidden flex flex-col"
        :class="selectedId === {{ $item->id }} ? 'border-emerald-600 ring-2 ring-emerald-500/25' : 'border-gray-100 hover:border-emerald-500/60'"
        style="animation: fadeIn 0.5s ease-out {{ $index * $delay }}s both;">

    {{-- Gambar di atas --}}
    <div class="relative aspect-[4/3] bg-white overflow-hidden flex items-center justify-center shrink-0">
        @if($hasImage)
        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        @endif
        <div x-show="selectedId === {{ $item->id }}" x-cloak
             class="absolute top-2 right-2 inline-flex items-center gap-1 rounded-full bg-emerald-600 text-white text-[9px] font-bold px-2 py-0.5 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            Dipilih
        </div>
    </div>

    {{-- Teks di bawah --}}
    <div class="p-3 sm:p-3.5 flex-1 flex flex-col">
        @if($category)
        <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-dark-green/80 leading-none">{{ $category->name }}</p>
        @endif
        <h3 class="mt-1 font-serif text-base md:text-lg font-bold leading-snug tracking-tight text-slate-950 break-words">{{ $item->title }}</h3>

        @if($item->info)
        <p class="mt-1 text-[13px] md:text-sm font-medium text-slate-700 leading-relaxed">{{ $item->info }}</p>
        @endif

        @if($price)
        <div class="mt-2 pt-2 border-t border-dashed border-gray-100">
            <p class="text-[10px] md:text-[11px] font-bold uppercase tracking-[0.16em] text-dark-green/80 leading-none">Harga</p>
            <p class="mt-1 text-base md:text-lg font-extrabold tabular-nums tracking-tight text-dark-green leading-none">
                SAR {{ number_format($price, 0, ',', '.') }}
            </p>
        </div>
        @else
        <div class="mt-2 pt-2 border-t border-dashed border-gray-100">
            <p class="text-[10px] md:text-[11px] font-bold uppercase tracking-[0.16em] text-dark-green/80 leading-none">Harga</p>
            <p class="mt-1 text-[13px] md:text-sm font-semibold text-slate-700 leading-none">Hubungi kami</p>
        </div>
        @endif

        {{-- Tombol Pilih (mobile saja, tengah kartu full-width) --}}
        <div class="mt-auto pt-3 flex justify-center lg:hidden">
            <span role="button" tabindex="0"
                  @click.stop="selectItem({{ $item->id }}, {{ $service?->id ?? 'null' }}, @js($item->title), {{ $price ?? 'null' }}, @js($item->info))"
                  class="inline-flex w-full h-9 items-center justify-center rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-xs font-bold px-4 shadow-lg shadow-[#25D366]/25 active:scale-[0.98] transition-all whitespace-nowrap truncate max-w-full">
                Pilih {{ $item->title }}
            </span>
        </div>
    </div>
</button>
