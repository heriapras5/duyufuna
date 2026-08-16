{{-- Detail Modal --}}
<div x-data="" x-show="$store.modal.openDetail" x-cloak x-transition.opacity.duration.200ms
     class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6"
     @keydown.escape.window="$store.modal.closeDetail()">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-md" @click="$store.modal.closeDetail()"></div>
    <div class="relative w-full max-w-sm lg:max-w-md bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[88vh] sm:max-h-[90vh] flex flex-col">
        {{-- Tombol tutup (pojok kanan atas kartu) --}}
        <button type="button" @click="$store.modal.closeDetail()" aria-label="Tutup"
                class="absolute top-3 right-3 z-10 w-7 h-7 rounded-full bg-white/95 backdrop-blur shadow-md flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>

        {{-- Gambar kotak ringkas (dihilangkan bila tidak ada) --}}
        <div class="shrink-0 pt-5 pb-2 px-5 md:px-6" x-show="$store.modal.detail.image" x-cloak>
            <img :src="$store.modal.detail.image" :alt="$store.modal.detail.title" loading="lazy"
                 class="w-full h-44 md:h-52 object-cover rounded-2xl ring-1 ring-gray-100 shadow-sm">
        </div>

        {{-- Isi --}}
        <div class="flex-1 min-h-0 overflow-y-auto px-5 md:px-6 py-4 md:py-5 space-y-3">
            <h3 class="font-serif text-lg md:text-xl font-bold text-gray-900 leading-snug pr-6" x-text="$store.modal.detail.title"></h3>
            <div class="pt-3 border-t border-gray-100 modal-prose"
                 x-show="$store.modal.detail.description" x-html="$store.modal.detail.description"></div>
        </div>

        {{-- CTA --}}
        <div class="shrink-0 px-5 md:px-6 pt-2 pb-5 md:pb-6">
            <button type="button" @click="$store.modal.gotoConsult()"
                    class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-semibold rounded-full shadow-sm hover:shadow-md active:scale-[0.98] transition-all duration-200 py-3 px-6 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                Konsultasi Sekarang
            </button>
        </div>
    </div>
</div>