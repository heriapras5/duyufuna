{{-- Detail Modal --}}
<div x-data="" x-show="$store.modal.openDetail" x-cloak x-transition.opacity.duration.200ms
     class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6"
     @keydown.escape.window="$store.modal.closeDetail()">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-md" @click="$store.modal.closeDetail()"></div>
    <div class="relative w-full max-w-lg lg:max-w-xl">
        {{-- Tombol tutup (menempel sudut luar kanan atas kartu) --}}
        <button type="button" @click="$store.modal.closeDetail()" aria-label="Tutup"
                class="absolute -top-3 -right-3 sm:-top-4 sm:-right-4 z-10 w-9 h-9 rounded-full bg-white shadow-lg ring-1 ring-gray-200 flex items-center justify-center text-gray-500 hover:text-red-500 hover:rotate-90 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[88vh] sm:max-h-[90vh] flex flex-col">

        {{-- Isi: gambar + teks dalam satu area scroll (deskripsi tidak terhimpit) --}}
        @php $modalCat = ($category->slug ?? null) ?? ($service->category->slug ?? null) ?? ''; @endphp
        <div class="flex-1 min-h-0 overflow-y-auto px-5 md:px-6 pt-5 pb-2 space-y-3 {{ in_array($modalCat, ['jastip-viral', 'catering']) ? 'modal-scroll' : '' }}">
            {{-- Bingkai gambar: rasio tetap 4:2, foto memenuhi bingkai --}}
            <div class="relative w-full aspect-[4/2] bg-slate-100 overflow-hidden rounded-xl ring-1 ring-gray-100 shadow-sm">
                <img x-show="$store.modal.detail.image" x-cloak :src="$store.modal.detail.image" :alt="$store.modal.detail.title" loading="lazy"
                     class="absolute inset-0 w-full h-full object-cover">
            </div>

            <h3 class="font-serif text-lg md:text-xl font-bold text-gray-900 leading-snug pr-6" x-text="$store.modal.detail.title"></h3>
            <div class="flex items-center justify-between gap-3 rounded-xl border border-emerald-200 bg-emerald-50/70 px-3.5 py-2.5"
                 x-show="$store.modal.detail.unit_price" x-cloak>
                <div class="min-w-0">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-emerald-700/70 leading-none">Harga</p>
                    <p class="mt-1.5 text-lg font-extrabold tabular-nums tracking-tight text-dark-green leading-none">
                        <span x-text="($store.modal.detail.currency || 'SAR') + ' ' + new Intl.NumberFormat('id-ID').format($store.modal.detail.unit_price)"></span>
                        @if(isset($unitSuffix))<span class="text-xs font-medium text-gray-400"> {{ $unitSuffix }}</span>@endif
                    </p>
                </div>
            </div>
            <div class="pt-3 border-t border-gray-100 modal-prose"
                 x-show="$store.modal.detail.description" x-html="$store.modal.detail.description"></div>
        </div>

        {{-- CTA --}}
        <div class="shrink-0 px-5 md:px-6 pt-2 pb-5 md:pb-6">
            <button type="button" @click="$store.modal.gotoConsult()"
                    class="w-full inline-flex items-center justify-center gap-2 bg-dark-green hover:bg-masjid text-white font-semibold rounded-full shadow-sm hover:shadow-md active:scale-[0.98] transition-all duration-200 py-3 px-6 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                Hubungi
            </button>
        </div>
    </div>
    </div>
</div>