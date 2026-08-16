@props([
    'color' => 'gray',
])

@php
    $colors = [
        'green' => 'bg-emerald-600 text-white',
        'red' => 'bg-red-600 text-white',
        'amber' => 'bg-amber-500 text-white',
        'blue' => 'bg-blue-600 text-white',
        'gray' => 'bg-gray-600 text-white',
        'gold' => 'bg-gold text-white',
    ];
    $color = $colors[$color] ?? $colors['gray'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold whitespace-nowrap ' . $color]) }}>
    {{ $slot }}
</span>
