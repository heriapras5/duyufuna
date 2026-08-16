@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'rows' => 4,
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
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
              @if($required)required @endif
              @if($placeholder)placeholder="{{ $placeholder }}" @endif
              {{ $attributes->merge(['class' => 'admin-input']) }}>{{ old($name, $value) }}</textarea>
    @error($name)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    @if($help)<p class="text-xs text-gray-400 mt-1">{{ $help }}</p>@endif
</div>
