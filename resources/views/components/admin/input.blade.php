@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'required' => false,
    'placeholder' => null,
    'help' => null,
    'wrapperClass' => null,
])

<div @class(['space-y-1.5', $wrapperClass])>
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)<span class="text-red-400">*</span>@endif
    </label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
           @if($required)required @endif
           @if($placeholder)placeholder="{{ $placeholder }}" @endif
           {{ $attributes->merge(['class' => 'admin-input']) }}>
    @error($name)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    @if($help)<p class="text-xs text-gray-400 mt-1">{{ $help }}</p>@endif
</div>
