{{-- Layout dua kolom handling ala Nusuk Center: kiri grid paket, kanan form + kalkulator PAX --}}
@props([
    'category',
    'service',
])

@php
    $firstItem = $service->serviceItems->first();
    $allPaxPrices = $service->serviceItems->mapWithKeys(fn ($i) => [$i->id => $i->paxPrices()]);
@endphp
<section id="layanan" class="scroll-mt-24 pt-2"
         x-data="{
             selected: { id: null, title: '', price: null },
             pax: 40,
             allPrices: @js($allPaxPrices),

             get tier() {
                 const prices = this.allPrices[this.selected.id];
                 if (!prices || !Array.isArray(prices)) return null;
                 return prices.find(t => this.pax >= t.min && this.pax <= t.max) || null;
             },
             get pricePerPax() {
                 return this.tier ? this.tier.price : null;
             },
             get total() {
                 return this.pricePerPax ? (this.pax * this.pricePerPax).toFixed(2) : '0.00';
             },
             get displayPrice() {
                 return this.pricePerPax ? '$' + Number(this.pricePerPax).toFixed(2) : '—';
             },

             selectItem(id, title, price) {
                 this.selected = { id, title, price };
             },
             formOpen: false,
             init() {
                 this.$watch('formOpen', (value) => {
                     document.body.classList.toggle('modal-body-lock', value);
                     this.$dispatch('hide-bottom-nav', value);
                 });
             },
             scrollCards(dir) {
                 const el = this.$refs.cards;
                 if (!el) return;
                 const amt = el.querySelector('.lg\\:hidden') ? (el.offsetWidth * 0.86) : 360;
                 el.scrollBy({ left: dir * amt, behavior: 'smooth' });
             },
         }">
    <div class="mt-3 grid gap-3 pb-20 lg:grid-cols-[minmax(0,1fr)_340px] xl:grid-cols-[minmax(0,1fr)_360px]">

        {{-- ===== KOLOM KIRI: Ground Handling + daftar paket ===== --}}
        <div class="min-w-0">
            {{-- Navigasi geser kartu: baris tombol di bawah carousel (mobile saja, tak menutupi kartu) --}}
            <div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm min-w-0">
            {{-- Header Paket Handling --}}
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between sm:gap-3">
                <h1 class="text-base sm:text-xl font-bold leading-tight tracking-normal text-slate-950 break-words">Paket Handling</h1>
                @if($service->short_description)
                <span class="self-start sm:self-auto inline-flex items-center gap-1 rounded-full bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 ring-1 ring-emerald-100 leading-snug max-w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span class="truncate">{{ $service->short_description }}</span>
                </span>
                @endif
            </div>

            {{-- Kontainer kartu --}}
            <div x-ref="cards"
                 class="flex snap-x snap-mandatory gap-3 overflow-x-auto scroll-smooth pb-2 items-stretch [scrollbar-width:none] lg:grid lg:grid-cols-3 lg:items-stretch lg:overflow-visible lg:pb-0 [&::-webkit-scrollbar]:hidden">
                    @foreach($service->serviceItems as $item)
                    @include('categories.partials.handling-card', [
                        'item' => $item,
                        'service' => $service,
                        'category' => $category,
                        'index' => $loop->index,
                    ])
                     @endforeach
                  </div>
                <div class="sm:hidden flex items-center justify-center gap-2 pt-3">
                    <button type="button" @click="scrollCards(-1)" aria-label="Paket sebelumnya"
                            class="inline-flex h-8 items-center gap-1 rounded-full border border-slate-200 bg-white/70 px-3.5 text-xs font-semibold text-slate-700 shadow-sm backdrop-blur-md transition active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        Sebelumnya
                    </button>
                    <button type="button" @click="scrollCards(1)" aria-label="Paket berikutnya"
                            class="inline-flex h-8 items-center gap-1 rounded-full border border-slate-200 bg-white/70 px-3.5 text-xs font-semibold text-slate-700 shadow-sm backdrop-blur-md transition active:scale-95">
                        Berikutnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
            </div>
        </div>

         {{-- ===== KOLOM KANAN: Form konsultasi + kalkulator PAX (desktop sticky; mobile modal) ===== --}}
        <div class="lg:hidden fixed inset-0 z-[70] bg-black/40 backdrop-blur-sm" x-show="formOpen" x-transition.opacity.duration.200ms @click="formOpen = false"></div>
        <div id="form-pesanan" class="min-w-0"
             :class="formOpen
                 ? 'fixed inset-0 z-[80] m-auto h-fit max-h-[85dvh] w-[calc(100%-1.5rem)] max-w-md overflow-y-auto rounded-2xl shadow-2xl lg:sticky lg:top-20 lg:inset-auto lg:z-auto lg:m-0 lg:h-auto lg:max-h-none lg:max-w-none lg:overflow-visible lg:shadow-sm'
                 : 'hidden lg:block lg:sticky lg:top-20'">
            <div class="lg:hidden flex justify-end pb-2">
                <button type="button" @click="formOpen = false" aria-label="Tutup"
                        class="w-9 h-9 rounded-full bg-white shadow-xl flex items-center justify-center text-slate-500 hover:text-red-500 active:scale-95 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
            <div class="relative rounded-2xl border border-slate-300 bg-white p-3 shadow-[0_14px_30px_rgba(15,23,42,0.08)] sm:p-5">
                {{-- Header: harga mengikuti PAX (kosong hingga ada paket dipilih) --}}
                <div class="flex items-center justify-between gap-2 pb-3 border-b border-dashed border-slate-200" x-show="selected?.id" x-cloak>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-slate-950">Paket <span class="text-gold" x-text="selected?.title || 'Belum ada pilihan'"></span></p>
                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Harga mengikuti jumlah PAX</p>
                    </div>
                    <p class="text-lg font-bold text-slate-950 shrink-0" x-text="displayPrice"></p>
                </div>

                {{-- Form konsultasi --}}
                <form method="POST" action="{{ route('customer.store') }}"
                      x-data="{ loading: false, submitted: false }"
                      @submit.prevent="if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <input type="hidden" name="item_id" :value="selected.id">
                    <input type="hidden" name="item_title" :value="'Paket ' + selected.title">
                    <input type="hidden" name="pax" :value="pax">
                    <input type="hidden" name="unit_price" :value="pricePerPax ?? ''">
                    <input type="hidden" name="currency" value="US$">
                    <input type="hidden" name="unit_label" value="PAX">

                    <div class="mt-4 space-y-4">
                        {{-- Total PAX --}}
                        <div>
                            <label class="flex items-center gap-1 text-xs font-medium text-slate-700">
                                Total PAX <span class="text-red-500">*</span>
                                <span class="text-[10px] text-slate-400 font-normal">(jumlah jamaah)</span>
                            </label>
                            <input type="number" x-model.number="pax" min="1" name="total_pax"
                                   class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 outline-none transition focus:border-gold/60 focus:ring-2 focus:ring-gold/20">
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="flex items-center gap-1 text-xs font-medium text-slate-700">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                                   class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 placeholder:text-slate-400 outline-none transition focus:border-gold/60 focus:ring-2 focus:ring-gold/20">
                        </div>

                        {{-- No WhatsApp --}}
                        <div>
                            <label class="flex items-center gap-1 text-xs font-medium text-slate-700">
                                No WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="no_hp" required autocomplete="tel" placeholder="0812xxxxxxx"
                                   class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 placeholder:text-slate-400 outline-none transition focus:border-gold/60 focus:ring-2 focus:ring-gold/20">
                        </div>

                        {{-- Ringkasan Harga (live) --}}
                        <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-3 space-y-2" x-show="selected?.id" x-cloak>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Ringkasan Harga</p>
                            <div class="flex items-center justify-between text-xs text-slate-600">
                                <span>Harga per PAX</span>
                                <span class="font-semibold" x-text="displayPrice"></span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-600">
                                <span>Jumlah PAX</span>
                                <span class="font-semibold" x-text="pax + ' PAX'"></span>
                            </div>
                            <template x-if="tier">
                                <div class="flex items-center justify-between text-xs text-slate-600">
                                    <span>Rentang PAX</span>
                                    <span class="font-semibold" x-text="tier.min + '–' + tier.max + ' Pax'"></span>
                                </div>
                            </template>
                            <template x-if="!tier">
                                <div class="flex items-center justify-between text-xs text-red-500">
                                    <span>Rentang PAX</span>
                                    <span>Di luar rentang</span>
                                </div>
                            </template>
                            <div class="pt-1.5 mt-1.5 border-t border-dashed border-slate-200 flex items-center justify-between">
                                <span class="text-xs font-semibold text-slate-700">Total Akhir</span>
                                <span class="text-base font-bold text-slate-950" x-text="'$' + total"></span>
                            </div>
                            <p class="text-[10px] text-slate-400 leading-tight">Harga perkiraan dan dapat berubah.</p>
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" :disabled="loading || !selected?.id"
                                class="w-full flex items-center justify-center gap-2 rounded-xl bg-[#25D366] hover:bg-[#128C7E] text-white text-sm font-bold py-2.5 transition-all active:scale-[0.99] disabled:opacity-50">
                            <span x-show="!loading" class="flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                Hubungi
                            </span>
                            <span x-show="loading" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                                Memproses...
                            </span>
                        </button>

                        <p class="text-[11px] text-slate-400 text-center leading-relaxed">Dengan mengirim, Anda menyetujui bahwa data Anda akan digunakan untuk keperluan konsultasi sesuai <a href="#" class="text-gold hover:text-amber-500">Kebijakan Privasi</a> kami.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>