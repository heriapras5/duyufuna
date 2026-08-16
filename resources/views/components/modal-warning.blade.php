@props(['id' => 'warningModal', 'title' => 'Perhatian!', 'message' => 'Apakah Anda yakin ingin melanjutkan?', 'confirmText' => 'Ya, Lanjutkan'])

<div x-data="{ open: false }"
     x-show="open"
     x-cloak
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="open = false"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl p-6 w-full max-w-sm text-center"
         x-trap.noscroll="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $title }}</h3>
        <p class="text-sm text-gray-500 mb-6">{{ $message }}</p>
        <div class="flex items-center gap-3 justify-center">
            <button @click="open = false" type="button" class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-600 text-sm font-medium rounded-xl transition">Batal</button>
            <button type="button" id="{{ $id }}-confirm" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition shadow-sm">{{ $confirmText }}</button>
        </div>
    </div>
</div>
