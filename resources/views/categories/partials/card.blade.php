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
@endphp

<div class="group card-glass-gold rounded-2xl overflow-hidden flex flex-col h-full">
    <div class="relative aspect-[4/3] bg-gradient-to-br from-mint to-emerald-50 overflow-hidden">
        @if($image && !str_ends_with($image, '.svg'))
        <img src="{{ Storage::url($image) }}" alt="{{ $title }}" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        @endif
    </div>
    <div class="px-4 pt-3 pb-4 md:px-5 md:pt-4 md:pb-5 flex-1 flex flex-col">
        <h3 class="text-sm md:text-base font-bold text-gray-900 leading-tight line-clamp-2">{{ $title }}</h3>
        @if($description)
        <div class="mt-2 pt-2 border-t border-gray-100 border-dashed">
            <p class="text-[11px] md:text-xs text-gray-500 leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($description), 130) }}</p>
        </div>
        @endif
        <div class="mt-auto pt-3.5 grid grid-cols-2 gap-2">
            <button type="button"
                    @click="$store.modal.setDetail({
                        service_id: {{ $service->id }},
                        item_title: @js($title),
                        image: @js($hasImage ? Storage::url($image) : null),
                        title: @js($title),
                        description: @js($popupDesc),
                    })"
                    class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-dark-green/25 text-dark-green hover:border-dark-green/50 hover:bg-dark-green/5 text-xs font-semibold py-2.5 px-3 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                Detail
            </button>
            <button type="button"
                    @click="$store.modal.setConsult({
                        service_id: {{ $service->id }},
                        item_id: @js($item_id),
                        item_title: @js($title),
                        title: @js($title),
                    })"
                    class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-xs font-semibold py-2.5 px-3 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                Konsultasi
            </button>
        </div>
    </div>
</div>