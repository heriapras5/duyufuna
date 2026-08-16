@props([
    'service' => null,
    'index' => 0,
    'delay' => 0.03,
    'url' => null,
])

@php
    $service = $service ?? $card ?? null;
    $href = $url ?? route('service.detail', $service->slug);
    $hasImage = $service->image && !str_ends_with($service->image, '.svg');
    $icon = $service->icon ?? null;
    $cardDesc = trim((string) $service->short_description)
        ?: trim(strip_tags((string) $service->description));
    $cardDesc = Str::limit($cardDesc, 130);
@endphp

<a href="{{ $href }}"
   class="group relative rounded-2xl overflow-hidden bg-white text-left transition-all duration-300 shadow-sm ring-1 ring-gray-100 hover:-translate-y-1 hover:shadow-lg focus:outline-none flex flex-col"
   style="animation: fadeIn 0.5s ease-out {{ $index * $delay }}s both;">
    <div class="relative aspect-[4/3] bg-gradient-to-br from-mint to-emerald-50 overflow-hidden">
        @if($hasImage)
        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent pointer-events-none"></div>
    </div>
    <div class="flex-1 flex flex-col p-3.5 md:p-4">
        <h3 class="text-xs md:text-base font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-dark-green transition-colors">{{ $service->title }}</h3>
        @if($cardDesc)
        <div class="mt-2 pt-2 border-t border-gray-100 border-dashed">
            <p class="text-[11px] md:text-xs text-gray-500 leading-relaxed line-clamp-3">{{ $cardDesc }}</p>
        </div>
        @endif
        <span class="mt-auto pt-3 inline-flex items-center gap-1.5 text-gold text-[11px] md:text-xs font-semibold group-hover:gap-2.5 transition-all">
            Lihat
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </span>
    </div>
</a>
