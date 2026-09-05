@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)
@section('og_image', $services->first()?->image)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-5 pb-10 md:pt-6 md:pb-12 max-w-7xl mx-auto space-y-4 sm:space-y-6">
    <div class="flex items-center gap-3 sm:gap-4">
        <a href="{{ route('home') }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition shrink-0 border border-slate-200/60 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="min-w-0">
            <h1 class="font-serif text-base sm:text-lg md:text-xl font-bold text-gray-900 leading-tight break-words">{{ $category->name }}</h1>
            @if($category->subtitle)
            <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
            @endif
        </div>
    </div>

    <section class="max-w-xl mx-auto w-full">
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden rounded-2xl">
            {{-- Header kartu --}}
            <div class="px-5 md:px-6 pt-6 pb-5 border-b border-dashed border-gray-100 bg-gradient-to-br from-emerald-50/60 to-white">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 flex items-center justify-center ring-1 ring-green-200 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"/><path d="M8 3H3v5"/><path d="M21 3l-7 7"/><path d="M3 3l7 7"/><path d="M16 21h5v-5"/><path d="M8 21H3v-5"/><path d="M21 21l-7-7"/><path d="M3 21l7-7"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h2 class="font-serif text-base md:text-lg font-bold text-gray-900 leading-tight">Konsultasi {{ $category->name }}</h2>
                        <p class="text-[11px] md:text-xs text-gray-500 mt-0.5">Isi data Anda, request akan dikirim via WhatsApp.</p>
                    </div>
                </div>
            </div>

            <div class="px-5 md:px-6 py-6 md:py-7">
                <form method="POST" action="{{ route('customer.store') }}"
                      x-data="{ loading: false, submitted: false }"
                      @submit.prevent="if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ submitted = false; loading = false; setTimeout(function(){ window.location.href = d.redirect_url; }, 200); } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="service_id" value="{{ $services->first()?->id }}">
                    <input type="hidden" name="item_title" value="{{ $services->first()?->title }}">
                    <input type="hidden" name="unit_label" value="layanan">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <input type="text" name="nama" required autocomplete="name" placeholder="Nama Anda"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">No WhatsApp <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <input type="tel" name="no_hp" required autocomplete="tel" placeholder="0812xxxxxxx"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" :disabled="loading"
                                    class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold rounded-full shadow-lg shadow-[#25D366]/25 hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 py-3 px-5 text-sm disabled:opacity-60">
                                <span x-show="!loading" class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                    Kirim Request
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
        </div>
    </section>
</div>
@endsection
