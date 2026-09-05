@props([
    'service' => null,
    'index' => 0,
])

@php
    $hasImage = $service->image && !str_ends_with($service->image, '.svg');
    $minSar = $service->price_sar !== null ? number_format((float) $service->price_sar, 0, ',', '.') : null;
    $capacityLabel = $service->capacityLabel();
@endphp

<button type="button"
        @click="selectVehicle({ id: @js($service->id), title: @js($service->title), price: {{ $service->price_sar ?? 'null' }} })"
        class="group relative w-full rounded-2xl bg-white border-2 p-3 sm:p-3.5 text-left transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 focus:outline-none cursor-pointer overflow-hidden"
        :class="selected?.id === {{ $service->id }} ? 'border-emerald-600 ring-2 ring-emerald-500/25' : 'border-gray-100 hover:border-emerald-500/60'">
    <div class="flex gap-3 sm:gap-4">
        {{-- Gambar: tampil penuh (contain), tanpa crop --}}
        <div class="relative w-28 sm:w-36 lg:w-40 aspect-[4/3] rounded-xl overflow-hidden bg-white ring-1 ring-slate-100 shrink-0">
            @if($hasImage)
            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" loading="lazy"
                 class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-105">
            @endif
            <div x-show="selected?.id === {{ $service->id }}" x-cloak
                 class="absolute top-1.5 right-1.5 inline-flex items-center gap-1 rounded-full bg-emerald-600 text-white text-[9px] font-bold px-2 py-0.5 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                Dipilih
            </div>
        </div>

        {{-- Konten --}}
        <div class="min-w-0 flex-1 flex flex-col">
            <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.16em] text-gold leading-none">Transportasi</p>
            <h3 class="mt-1 font-serif text-base md:text-lg font-bold leading-snug tracking-tight text-slate-950 break-words">{{ $service->title }}</h3>

            @if($capacityLabel)
            <div class="mt-1.5 flex items-center gap-1.5 text-xs md:text-[13px] font-medium text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <span>{{ $capacityLabel }}</span>
            </div>
            @endif

            @if($minSar)
            <div class="mt-auto pt-2 flex items-end justify-between gap-2">
                <div>
                    <p class="text-[10px] md:text-[11px] font-bold uppercase tracking-[0.16em] text-dark-green/80 leading-none" x-text="(pickup && dropoff) ? 'Harga Rute' : 'Mulai Dari'">Mulai Dari</p>
                    <p class="mt-1 text-base md:text-lg font-extrabold tabular-nums tracking-tight text-dark-green leading-none">
                        <span x-text="routePriceFor('{{ addslashes($service->title) }}') ?? 'SAR {{ $minSar }}'">SAR {{ $minSar }}</span>
                        <span class="text-[11px] md:text-xs font-medium text-gray-600">/ kendaraan</span>
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</button>
