{{-- Konsultasi Modal --}}
<div x-data="" x-show="$store.modal.openConsult" x-cloak x-transition.opacity.duration.200ms
     class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6"
     @keydown.escape.window="$store.modal.closeConsult()">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-md" @click="$store.modal.closeConsult()"></div>
    <div class="relative w-full max-w-md sm:max-w-lg bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[92vh] flex flex-col">
        <button type="button" @click="$store.modal.closeConsult()" aria-label="Tutup"
                class="absolute top-3 right-3 z-10 w-10 h-10 rounded-full bg-gray-100 hover:bg-red-50 flex items-center justify-center text-gray-500 hover:text-red-500 hover:rotate-90 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>

        <div class="shrink-0 px-5 md:px-7 pt-6 pb-5 border-b border-dashed border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 flex items-center justify-center ring-1 ring-green-200 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 font-serif leading-tight">Konsultasi Sekarang</h3>
                    <p class="text-sm text-gray-600 truncate mt-0.5" x-text="$store.modal.consult.title"></p>
                </div>
            </div>
        </div>

        <div class="flex-1 min-h-0 overflow-y-auto px-5 md:px-7 py-6">
            <form method="POST" action="{{ route('customer.store') }}"
                  @submit.prevent="$store.modal.submitConsult($el)">
                @csrf
                <input type="hidden" name="service_id" x-bind:value="$store.modal.consult.service_id">
                <input type="hidden" name="item_id" x-bind:value="$store.modal.consult.item_id">
                <input type="hidden" name="item_title" x-bind:value="$store.modal.consult.item_title">
                <input type="hidden" name="unit_price" x-bind:value="$store.modal.consult.unit_price ?? ''">
                <input type="hidden" name="currency" x-bind:value="$store.modal.consult.currency || 'SAR'">
                <input type="hidden" name="unit_label" x-bind:value="$store.modal.consult.unit_label || ''">
                <input type="hidden" name="extra_note" x-bind:value="$store.modal.consult.extra_note || ''">

                <div class="space-y-5">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-800 mb-1.5">Nama <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-gray-800 mb-1.5">No WhatsApp <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <input type="tel" name="no_hp" required autocomplete="tel"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                                   placeholder="0812xxxxxxx">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" :disabled="$store.modal.loadingConsult"
                                class="w-full flex items-center justify-center gap-2 bg-dark-green hover:bg-masjid text-white font-bold rounded-full shadow-lg shadow-dark-green/25 hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 py-3 px-5 text-sm">
                            <span x-show="!$store.modal.loadingConsult" class="flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                Hubungi
                            </span>
                            <span x-show="$store.modal.loadingConsult" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 text-center leading-relaxed">Dengan mengirim, Anda menyetujui bahwa data Anda akan digunakan untuk keperluan konsultasi sesuai <a href="#" class="text-gold hover:text-amber-500">Kebijakan Privasi</a> kami.</p>
                </div>
            </form>
        </div>
    </div>
</div>