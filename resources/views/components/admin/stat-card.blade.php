@props([
    'label' => null,
    'value' => null,
    'tone' => 'green',
    'icon' => null,
    'hint' => null,
    'delta' => null,
    'deltaPositive' => true,
    'footer' => null,
    'labelId' => null,
    'valueId' => null,
    'hintId' => null,
    'footerId' => null,
    'deltaId' => null,
    'href' => null,
])

@php($toneClass = [
    'blue' => 'bg-blue-600',
    'amber' => 'bg-amber-500',
    'green' => 'bg-emerald-600',
    'violet' => 'bg-violet-600',
    'teal' => 'bg-teal-600',
    'rose' => 'bg-rose-600',
    'gold' => 'bg-gold',
][$tone] ?? 'bg-emerald-600')

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group block bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col h-full transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 hover:border-gray-300']) }}>
@else
<div {{ $attributes->merge(['class' => 'group bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col h-full transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 hover:border-gray-300']) }}>
@endif
    <div class="p-4 sm:p-5 flex-1 flex flex-col">
        <div class="flex items-start justify-between gap-3 mb-3">
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-medium truncate" @if($labelId)id="{{ $labelId }}"@endif>{{ $label }}</p>
                @if($hint !== null && $hint !== '')<p class="text-[10px] text-gray-400 italic mt-1 truncate" @if($hintId)id="{{ $hintId }}"@endif>{{ $hint }}</p>@endif
            </div>
            @if($icon)
            <div class="w-10 h-10 rounded-xl {{ $toneClass }} flex items-center justify-center text-white shadow-md shrink-0 transition-transform duration-200 group-hover:scale-110">
                {!! $icon !!}
            </div>
            @endif
        </div>
        <p class="stat-value-text text-2xl lg:text-3xl font-bold text-gray-900 tabular-nums leading-none font-inter transition-all duration-300" @if($valueId)id="{{ $valueId }}"@endif>{{ $value }}</p>
        @if($delta !== null)
        <div @if($deltaId)id="{{ $deltaId }}"@endif @class(['mt-2 text-xs font-semibold flex items-center gap-1 font-inter', $deltaPositive ? 'text-emerald-600' : 'text-red-500'])>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $deltaPositive ? 'm7 17 10-10' : 'm7 7 10 10' }}"/><path d="{{ $deltaPositive ? 'M9 7h8v8' : 'M9 17h8V9' }}"/></svg>
            {{ $delta }}% vs periode lalu
        </div>
        @endif
        @if($footer)
        <div class="mt-2 text-xs text-gray-500" @if($footerId)id="{{ $footerId }}"@endif>{{ $footer }}</div>
        @endif
    </div>
    <div class="h-1.5 rounded-b-xl {{ $toneClass }}"></div>
@if($href)
</a>
@else
</div>
@endif
