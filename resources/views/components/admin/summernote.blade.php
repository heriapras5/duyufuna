@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'required' => false,
    'help' => null,
    'height' => 260,
    'wrapperClass' => '',
])

<div class="space-y-1.5 {{ $wrapperClass }}">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)<span class="text-red-400">*</span>@endif
    </label>
    @endif
    <textarea name="{{ $name }}" id="{{ $name }}" class="summernote" @if($height !== 260) data-height="{{ $height }}" @endif
              @if($required)required @endif>{{ old($name, $value) }}</textarea>
    @error($name)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    @if($help)<p class="text-xs text-gray-400 mt-1">{{ $help }}</p>@endif
</div>
