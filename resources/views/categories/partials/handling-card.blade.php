@props([
    'item' => null,
    'service' => null,
    'category' => null,
    'index' => 0,
])

@php
    $item = $item ?? $card ?? null;
    $category = $category ?? $service?->category ?? null;
    $benefits = $item->benefitList();
    $paxPrices = collect($item->paxPrices())->sortBy('min')->values()->all();
    $pricePerPax = count($paxPrices) > 0 ? (float) collect($paxPrices)->min('price') : null;

    // Ikon sesuai nama paket (setiap kartu tetap styling sama, hanya ikonnya beda).
    $key = mb_strtolower(trim((string) $item->title));
    $icon = match (true) {
        str_contains($key, 'platinum') => 'diamond',
        str_contains($key, 'gold')     => 'crown',
        default                        => 'shield', // SILVER & lainnya
    };
@endphp

<button type="button"
        data-handling-card="true"
        :aria-pressed="String(selected?.id === {{ $item->id }})"
        @click="selected = { id: {{ $item->id }}, title: @js($item->title), price: {{ $pricePerPax ?? 'null' }} }; if (window.innerWidth < 1024) formOpen = true;"
        class="group h-full min-h-[300px] w-[86vw] shrink-0 snap-center overflow-hidden rounded-2xl border bg-white text-left transition active:scale-[0.99] sm:min-h-[340px] sm:w-[340px] lg:w-auto flex flex-col"
        :class="selected?.id === {{ $item->id }}
            ? 'border-emerald-600 shadow-[0_18px_42px_rgba(5,92,59,0.20)] ring-2 ring-emerald-500/25'
            : 'border-slate-300 shadow-[0_10px_24px_rgba(15,23,42,0.06)] hover:border-emerald-500/60 hover:shadow-[0_14px_30px_rgba(5,92,59,0.10)]'">

    {{-- Header: ikon paket + nama paket --}}
    <div class="relative flex flex-col items-center pt-6 sm:pt-7 pb-4 px-4 overflow-hidden border-b border-slate-100 bg-gradient-to-b from-emerald-50/50 to-white shrink-0">
        {{-- halo lembut di belakang ikon --}}
        <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-24 h-24 rounded-full opacity-20 blur-2xl bg-emerald-400"></div>

        {{-- Ikon paket (medali, warna per tier) --}}
        <div class="relative flex items-center justify-center">
            @php $medalStroke = $icon === 'diamond' ? '#6366f1' : ($icon === 'crown' ? '#d97706' : '#94a3b8'); @endphp
            <svg viewBox="0 0 24 24" class="size-11 sm:size-12 transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-3"
                 fill="none" stroke="{{ $medalStroke }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7.21 15 2.66 7.14a2 2 0 0 1 .13-2.2L4.4 2.8A2 2 0 0 1 6 2h12a2 2 0 0 1 1.6.8l1.6 2.14a2 2 0 0 1 .14 2.2L16.79 15"/>
                <path d="M11 12 5.12 2.2"/>
                <path d="m13 12 5.88-9.8"/>
                <path d="M8 7h8"/>
                <circle cx="12" cy="17" r="5"/>
                <path d="M12 18v-2h-.5"/>
            </svg>
        </div>

        {{-- Nama paket + harga mulai --}}
        <h3 class="mt-3 font-serif text-base sm:text-lg md:text-xl font-bold text-slate-950 leading-tight text-center break-words">{{ $item->title }}</h3>
        @if($pricePerPax !== null)
        <p class="mt-2 text-sm font-semibold text-slate-700">Mulai</p>
        <p class="mt-1.5 text-xl md:text-2xl font-extrabold text-slate-950 leading-none tabular-nums">${{ number_format($pricePerPax, 2) }} <span class="text-[13px] md:text-sm font-medium text-slate-500">/ Pax</span></p>
        @endif
    </div>

    {{-- Body: tagline + include + detail harga --}}
    <div class="p-4 sm:p-5 flex-1 flex flex-col min-h-0">
        @if($item->tagline)
        <p class="text-[13px] md:text-sm font-medium leading-5 md:leading-6 text-slate-700 line-clamp-2">{{ $item->tagline }}</p>
        @endif

        @if(count($benefits) > 0)
        <div class="mt-3 pt-3 border-t border-dashed border-slate-200">
            <p class="text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em] text-dark-green/80 leading-none mb-2">Include</p>
            <ul class="space-y-1.5">
                @foreach($benefits as $b)
                <li class="flex items-start gap-2 text-[13px] md:text-sm text-slate-700 leading-snug">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 shrink-0 text-emerald-600"><path d="M20 6 9 17l-5-5"/></svg>
                    <span>{{ $b }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Penjelasan detail harga per rentang PAX (kartu tersendiri) --}}
        @if(count($paxPrices) > 0)
        <div class="mt-auto pt-3">
            <div class="rounded-xl border border-emerald-100 bg-emerald-50/60 overflow-hidden">
                <p class="px-3 py-2 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em] text-dark-green leading-none bg-emerald-100/60 border-b border-emerald-100">Detail Harga</p>
                <ul class="divide-y divide-emerald-100/70 px-3 py-1">
                    @foreach($paxPrices as $t)
                    <li class="flex items-center justify-between py-1.5 gap-3">
                        <span class="text-xs text-slate-600">{{ $t['min'] }}–{{ $t['max'] }} Pax</span>
                        <span class="text-xs font-bold tabular-nums text-dark-green">${{ number_format($t['price'], 2) }}<span class="font-medium text-slate-400">/Pax</span></span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Tombol Pilih paket (mobile saja, tengah kartu full-width) --}}
        <div class="mt-3 pt-1 flex justify-center lg:hidden">
            <span role="button" tabindex="0"
                  @click.stop="selected = { id: {{ $item->id }}, title: @js($item->title), price: {{ $pricePerPax ?? 'null' }} }; if (window.innerWidth < 1024) formOpen = true;"
                  class="inline-flex w-full h-9 items-center justify-center gap-1.5 rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-xs font-bold px-4 shadow-lg shadow-[#25D366]/25 active:scale-[0.98] transition-all truncate">
                Pilih {{ $item->title }}
            </span>
        </div>
    </div>
</button>