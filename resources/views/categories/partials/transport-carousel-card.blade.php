@props([
    'service' => null,
])

@php
    $hasImage = $service->image && !str_ends_with($service->image, '.svg');
    $capacityLabel = $service->capacityLabel();
@endphp

<div class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-amber-200">
    {{-- Gambar mobil: tampil penuh (contain), tanpa crop --}}
    <a href="{{ route('service.detail', $service->slug) }}" class="relative block aspect-[4/3] bg-white overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center p-2">
            @if($hasImage)
            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" loading="lazy"
                 class="max-h-full max-w-full w-auto h-auto object-contain transition-transform duration-500 group-hover:scale-105">
            @endif
        </div>
    </a>

    {{-- Konten --}}
    <div class="px-3 pt-2 pb-3 flex flex-col gap-1.5 flex-1">
        <h3 class="text-[13px] font-bold text-gray-900 leading-snug line-clamp-2 min-h-[2.4em]">{{ $service->title }}</h3>
        @if($capacityLabel)
        <p class="text-[11px] text-slate-600 leading-snug">{{ $capacityLabel }}</p>
        @endif
        <a href="{{ route('service.detail', $service->slug) }}"
           class="mt-auto inline-flex h-8 items-center justify-center gap-1 rounded-lg bg-white border border-slate-200 px-2.5 text-xs font-semibold text-slate-700 shadow-sm transition-all duration-300 hover:bg-slate-50 hover:shadow-md w-full">
            Detail
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><path d="m9 18 6-6-6-6"/></svg>
        </a>
    </div>
</div>
