@props([
    'service' => null,
    'category' => null,
    'url' => null,
])

@php
    $service = $service ?? $card ?? null;
    $category = $category ?? $service?->category ?? null;
    $href = $url ?? route('category.service', [$category?->slug, $service?->slug]);
    $hasImage = $service->image && !str_ends_with($service->image, '.svg');
    $cardDesc = trim((string) $service->short_description)
        ?: trim(strip_tags((string) $service->description));
    $recommended = $service->serviceItems ?? collect();
    if ($recommended instanceof \Illuminate\Support\Collection === false) {
        $recommended = collect($recommended);
    }
    $recommended = $recommended->take(3);
@endphp

<article class="group overflow-hidden rounded-2xl card-glass-gold">
    <div class="grid gap-3 sm:gap-4 p-3 sm:p-4 grid-cols-[96px_minmax(0,1fr)] sm:grid-cols-[140px_minmax(0,1fr)] lg:grid-cols-[160px_minmax(0,1fr)_200px]">

        {{-- Kolom 1: Gambar --}}
        <a href="{{ $href }}" class="relative flex aspect-[4/3] items-center justify-center overflow-hidden rounded-xl bg-white shrink-0">
            @if($hasImage)
            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            @endif
        </a>

        {{-- Kolom 2: Konten --}}
        <div class="min-w-0 flex flex-col">
            @if($category)
            <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.16em] text-gold/90 leading-none">{{ $category->name }}</p>
            @endif
            <h3 class="mt-1.5 font-serif text-[15px] md:text-[17px] font-bold leading-snug tracking-tight text-gray-900 break-words">{{ $service->title }}</h3>

            @if($cardDesc)
            <div class="mt-1.5 sm:mt-2">
                <p class="text-xs md:text-[13px] text-gray-500 leading-relaxed line-clamp-3">{{ $cardDesc }}</p>
            </div>
            @endif

            @if($service->price)
            <div class="mt-2.5 pt-2.5 border-t border-gray-100 border-dashed">
                <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em] text-gold/80 leading-none">Harga</p>
                <p class="mt-1 text-[15px] md:text-base font-bold tabular-nums tracking-tight text-dark-green leading-none">Rp {{ number_format((float) $service->price, 0, ',', '.') }}</p>
            </div>
            @endif

            @if($recommended->isNotEmpty())
            <div class="mt-2.5 pt-2.5 border-t border-gray-100 border-dashed">
                <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em] text-gold/80 leading-none">Rekomendasi Hotel</p>
                <ul class="mt-1.5 space-y-1">
                    @foreach($recommended as $hotel)
                    @php $hotelHref = $hotel->slug ? route('detail.show', $hotel->slug) : null; @endphp
                    <li class="flex items-start gap-1.5 text-xs md:text-[13px] text-gray-600 leading-snug">
                        <span class="text-emerald-600 leading-snug shrink-0">•</span>
                        @if($hotelHref)
                        <a href="{{ $hotelHref }}" class="hover:text-dark-green transition-colors line-clamp-1">{{ $hotel->title }}</a>
                        @else
                        <span class="line-clamp-1">{{ $hotel->title }}</span>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>

        {{-- Kolom 3: Tombol --}}
        <div class="flex flex-col justify-center gap-2.5 sm:gap-3 rounded-xl card-glass-gold p-3 sm:p-3.5 col-span-2 lg:col-span-1">
            <a href="{{ $href }}"
               class="inline-flex h-9 items-center justify-center gap-1.5 rounded-xl bg-white border border-slate-200 px-3 text-xs md:text-[13px] font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-slate-300">
                Lihat {{ $category->itemLabel() ?: 'Detail' }}
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>

    </div>
</article>
