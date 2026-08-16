@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'required' => false,
    'placeholder' => null,
    'help' => null,
    'wrapperClass' => null,
])

@php
    $emojis = ['🕋', '🕌', '🕍', '📿', '🧕', '👳', '🌙', '⭐️', '🌟', '☀️', '✈️', '🛫', '🛬', '🚢', '⛴️', '🚌', '🚐', '🚕', '🚗', '🛵', '🏨', '🏩', '🏛️', '🔑', '🗝️', '🧳', '🎒', '🛍️', '📦', '💼', '🛒', '🎁', '📜', '✒️', '💳', '💱', '💰', '📞', '☎️', '📱', '📧', '🌐', '🗺️', '⏰', '📅', '🤝', '🛡️', '♿'];
@endphp

<div @class(['space-y-1.5', $wrapperClass])
     x-data="{
        open: false,
        val: @js(old($name, $value)),
        pos: { top: 0, left: 0, width: 0 },
        positionPanel() {
            const r = this.$refs.row.getBoundingClientRect();
            const w = Math.min(340, window.innerWidth - r.left - 8);
            const h = 320;
            let top = r.bottom + 8;
            if (top + h > window.innerHeight) top = Math.max(8, r.top - h - 8);
            this.pos = { top: top, left: r.left, width: w };
        }
     }"
     @click.outside="open = false">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)<span class="text-red-400">*</span>@endif
    </label>
    @endif
    <div class="flex items-center gap-2" x-ref="row">
        <input type="text" name="{{ $name }}" id="{{ $name }}" x-model="val"
               value="{{ old($name, $value) }}" maxlength="8"
               @if($required)required @endif
               @if($placeholder)placeholder="{{ $placeholder }}" @endif
               class="admin-input"
               @click="open = true; positionPanel()">
        <button type="button" @click="open = !open; if (open) positionPanel()"
                class="shrink-0 w-11 h-11 rounded-xl border border-gray-200 bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-xl transition"
                title="Pilih emoji">
            <span x-text="val || '😊'" :class="!val && 'opacity-40'"></span>
        </button>
    </div>

    <template x-teleport="body">
        <div x-show="open" x-cloak x-transition.opacity
             :style="'position:fixed;top:' + pos.top + 'px;left:' + pos.left + 'px;width:' + pos.width + 'px;z-index:1000'"
             @click.outside="open = false">
            <div class="bg-white rounded-xl border border-gray-200 shadow-lg p-3">
                <p class="text-xs font-semibold text-gray-400 mb-2">Pilih emoji sesuai tema</p>
                <div class="grid grid-cols-8 gap-1">
                    @foreach($emojis as $emoji)
                    <button type="button" @click="val = '{{ $emoji }}'; open = false"
                            class="aspect-square rounded-lg hover:bg-emerald-50 hover:ring-1 hover:ring-emerald-200 text-xl flex items-center justify-center transition"
                            title="{{ $emoji }}">{{ $emoji }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </template>

    @error($name)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    @if($help)<p class="text-xs text-gray-400 mt-1">{{ $help }}</p>@endif
</div>
