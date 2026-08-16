@extends('layouts.public')

@section('title', $service->meta_title ?: $service->title)
@section('meta_description', $service->meta_description ?: Str::limit(strip_tags($service->description), 160))
@section('seo_keywords', $service->meta_keywords)

@section('no_hero', true)

@section('content')
<div class="px-4 md:px-6 lg:px-8 py-6 md:py-10 max-w-7xl mx-auto space-y-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs md:text-sm text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-gold transition">Beranda</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <a href="{{ route('category.show', $service->category->slug) }}" class="hover:text-gold transition">{{ $service->category->name }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <span class="text-gray-600 font-medium truncate">{{ $service->title }}</span>
    </nav>

    {{-- Title Section --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('category.show', $service->category->slug) }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-600 transition shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="flex items-center gap-4 min-w-0">
            <div class="min-w-0">
                <h1 class="font-serif text-sm md:text-xl lg:text-2xl font-bold text-gray-900">{{ $service->title }}</h1>
            </div>
        </div>
    </div>

    {{-- Description (Summernote) --}}
    @if($service->description)
    <div class="bg-white rounded-2xl p-5 md:p-8 border border-gray-100/80 shadow-sm">
        <div class="article-content text-[13px] md:text-sm">{!! $service->description !!}</div>
    </div>
    @endif

    {{-- Service Items (kategori katalog: Hotel / Paket / Produk) --}}
    @if($service->category?->isCatalog() && $service->serviceItems->where('status', true)->count() > 0)
    @php
        $catLabel = $service->category->item_label ?? null;
        $itemLabel = ($catLabel !== null && $catLabel !== '')
            ? $catLabel
            : 'Pilihan'; // kategori non-katalog tanpa label tetap 'Pilihan'
        $itemHeading = $itemLabel === 'Pilihan' ? 'Pilihan Tersedia' : 'Daftar ' . $itemLabel;
        $itemSubtitle = $itemLabel === 'Pilihan'
            ? 'Berbagai pilihan untuk ' . $service->title
            : 'Pilihan ' . strtolower($itemLabel) . ' yang tersedia untuk Anda';
    @endphp
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100/80 shadow-sm">
        <div class="flex items-center gap-3 mb-6">
            <div>
                <h2 class="text-base font-bold text-gray-900">{{ $itemHeading }}</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $itemSubtitle }}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-5">
            @foreach($service->serviceItems->where('status', true) as $item)
            <div class="group rounded-2xl border border-gray-100 overflow-hidden bg-white transition-all duration-300 hover:shadow-lg hover:shadow-amber-100 hover:-translate-y-0.5">
                @if($item->image && !str_ends_with($item->image, '.svg'))
                <div class="relative aspect-video overflow-hidden bg-gray-50">
                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                @else
                <div class="aspect-video bg-gradient-to-br from-mint to-emerald-50"></div>
                @endif
                <div class="px-4 pb-4 pt-3">
                    <h3 class="text-xs md:text-sm font-bold text-gray-900 leading-snug">{{ $item->title }}</h3>
                    @if($item->description)
                    <div class="article-content text-[11px] text-gray-500 mt-1.5 leading-relaxed line-clamp-3">{!! $item->description !!}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Contact Form --}}
    <div class="card-glass-gold rounded-2xl md:rounded-3xl p-6 md:p-8 max-w-lg mx-auto">
        <div class="flex items-center gap-3 mb-2">
            <h3 class="text-lg md:text-xl font-bold text-gray-900 font-serif">Konsultasi</h3>
        </div>
        <p class="text-sm text-gray-400 mb-6">Isi form di bawah untuk informasi lebih lanjut via WhatsApp</p>
        <form method="POST" action="{{ route('customer.store') }}"
              x-data="{
                  loading: false,
                  init() {
                      window.addEventListener('pageshow', () => { this.loading = false; });
                  },
                  submitForm() {
                      this.loading = true;
                      fetch(this.$el.action, {
                          method: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': this.$el.querySelector('input[name=_token]').value,
                              'Accept': 'application/json',
                          },
                          body: new FormData(this.$el),
                      })
                      .then(response => response.json())
                      .then(data => {
                          if (data.redirect_url) {
                              window.location.href = data.redirect_url;
                          }
                      })
                      .catch(err => { alert('Gagal mengirim. Coba lagi.'); })
                      .finally(() => { this.loading = false; });
                  },
              }"
              @submit.prevent="submitForm()">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <input type="text" name="nama" required
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                               placeholder="Nama Anda">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">No WhatsApp <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <input type="tel" name="no_hp" required
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                               placeholder="0812xxxxxxx">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" :disabled="loading"
                            class="w-full bg-[#25D366] hover:bg-[#128C7E] text-white font-bold rounded-full shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-95 transition-all duration-300 justify-center py-3.5 px-6 text-sm flex items-center gap-2">
                        <span x-show="!loading" class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Konsultasi Sekarang
                        </span>
                        <span x-show="loading" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                            Memproses...
                        </span>
                    </button>
                </div>

                <p class="text-[11px] text-gray-400 text-center leading-relaxed">Dengan mengirim, Anda menyetujui bahwa data Anda akan digunakan untuk keperluan konsultasi sesuai <a href="#" class="text-gold hover:text-amber-500">Kebijakan Privasi</a> kami.</p>
            </div>
        </form>
    </div>

    {{-- Related Services --}}
    @if(isset($relatedServices) && $relatedServices->count() > 0)
    <section class="scroll-reveal">
        <div class="flex items-center gap-3 mb-6">
            <h2 class="text-lg font-bold text-gray-900">Layanan Terkait</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-5 stagger-children scroll-reveal">
            @foreach($relatedServices as $i => $related)
            <a href="{{ route('service.detail', $related->slug) }}"
               class="group rounded-2xl border border-gray-100 overflow-hidden bg-white transition-all duration-300 hover:shadow-lg hover:shadow-amber-100 hover:-translate-y-0.5">
                @if($related->image && !str_ends_with($related->image, '.svg'))
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}" loading="lazy"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                @else
                <div class="aspect-video bg-gradient-to-br from-mint to-emerald-50"></div>
                @endif
                <div class="px-4 pb-4 pt-3">
                    <h3 class="text-sm font-bold text-gray-900 leading-snug">{{ $related->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
