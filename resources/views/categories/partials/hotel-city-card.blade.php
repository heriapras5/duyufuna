@props([
    'service' => null,
    'category' => null,
    'index' => 0,
    'delay' => 0.05,
])

@php
    $href = route('category.service', [$category->slug, $service->slug]);
    $hasImage = $service->image && !str_ends_with($service->image, '.svg');
    $desc = trim((string) $service->short_description)
        ?: trim(strip_tags((string) $service->description));
    $desc = Str::limit($desc, 90);
    $items = $service->serviceItems ?? collect();
    if (!$items instanceof \Illuminate\Support\Collection) {
        $items = collect($items);
    }
    $recs = $items->take(3);
@endphp

<a href="{{ $href }}"
   class="group relative rounded-2xl overflow-hidden bg-white text-left transition-all duration-300 shadow-sm ring-1 ring-gray-100 hover:-translate-y-1 hover:shadow-lg focus:outline-none flex flex-col h-full"
   style="animation: fadeIn 0.5s ease-out both;">
    <div class="relative aspect-[4/3] bg-white overflow-hidden flex items-center justify-center">
        @if($hasImage)
        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @endif
    </div>

    <div class="flex-1 flex flex-col p-3.5 md:p-4">
        <h3 class="text-sm md:text-base font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-dark-green transition-colors">{{ $service->title }}</h3>
        @if($desc)
        <p class="mt-1.5 text-xs md:text-[13px] text-gray-500 leading-relaxed line-clamp-2">{{ $desc }}</p>
        @endif

        @if($recs->isNotEmpty() && !($category && $category->isHotel()))
        @php
            $recLabel = ($category && $category->isHotel())
                ? 'Rekomendasi Hotel'
                : ('Pilihan ' . ($category ? $category->itemLabel() : 'Item'));
        @endphp
        <div class="mt-2.5 pt-2.5 border-t border-gray-100 border-dashed">
            <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em] text-gold leading-none">{{ $recLabel }}</p>
            <ul class="mt-1.5 space-y-1">
                @foreach($recs as $hotel)
                <li class="flex items-start gap-1.5 text-xs md:text-[13px] text-gray-600 leading-snug">
                    <span class="text-emerald-600 leading-snug shrink-0">•</span>
                    <span class="line-clamp-1">{{ $hotel->title }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <span class="mt-auto pt-3">
            <span class="inline-flex h-9 items-center justify-center gap-1.5 w-full rounded-xl bg-white border border-slate-200 px-3 text-[13px] font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 group-hover:shadow-md">
                Lihat Daftar
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 shrink-0"><path d="m9 18 6-6-6-6"/></svg>
            </span>
        </span>
    </div>
</a>
