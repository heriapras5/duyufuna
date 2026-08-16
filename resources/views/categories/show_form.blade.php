@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-8 pb-14 md:pt-12 md:pb-20 max-w-7xl mx-auto space-y-5">
    <div class="flex items-start gap-4 mb-8">
        <a href="{{ route('home') }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-600 transition shrink-0 mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="flex items-center gap-4">
            @if($category->icon)
            <div class="w-9 h-9 md:w-10 md:h-10 rounded-2xl bg-gradient-to-br from-mint to-emerald-50 flex items-center justify-center text-base md:text-lg shadow-lg shrink-0 ring-1 ring-emerald-200">
                <span>{{ $category->icon }}</span>
            </div>
            @endif
            <div>
                <h1 class="font-serif text-lg md:text-xl font-bold text-gray-900">{{ $category->name }}</h1>
                @if($category->subtitle)
                <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
                @endif
            </div>
        </div>
    </div>

    @if($category->description)
    <section>
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-gray-100/80 shadow-sm">
            <div class="article-content text-[13px] md:text-sm text-gray-600 leading-relaxed">{!! $category->description !!}</div>
        </div>
    </section>
    @endif

    @php $firstService = $services->first(); @endphp
    <section class="max-w-xl mx-auto w-full scroll-reveal"
             x-data="{
                 serviceId: {{ $firstService ? $firstService->id : 'null' }},
                 itemTitle: {{ $firstService ? \Illuminate\Support\Js::from($firstService->title) : "''" }},
             }">
        <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            @if($services->count() > 1)
            <div class="px-5 md:px-6 pt-6 pb-4 border-b border-gray-100">
                <h2 class="font-serif text-base md:text-lg font-bold text-gray-900 leading-tight mb-3">Pilih Layanan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                    @foreach($services as $svc)
                    <button type="button"
                            @click="serviceId = {{ $svc->id }}; itemTitle = @js($svc->title)"
                            class="text-left rounded-xl border-2 p-2.5 transition-all duration-200"
                            :class="serviceId === {{ $svc->id }} ? 'border-gold bg-amber-50/60 shadow-sm' : 'border-gray-200 hover:border-gold/40'">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-semibold text-gray-900 leading-tight">{{ $svc->title }}</span>
                        </div>
                        @if($svc->short_description)
                        <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $svc->short_description }}</p>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
            @elseif($firstService)
            <div class="px-5 md:px-6 pt-6 pb-5 border-b border-dashed border-gray-100 bg-gradient-to-br from-emerald-50/60 to-white">
                <div class="flex items-center gap-3">
                    <div class="min-w-0">
                        <h2 class="font-serif text-base md:text-lg font-bold text-gray-900 leading-tight">{{ $firstService->title }}</h2>
                        @if($firstService->short_description)
                        <p class="text-xs md:text-sm text-gray-500 mt-0.5">{{ $firstService->short_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="px-5 md:px-6 pt-6 pb-5 border-b border-dashed border-gray-100 bg-gradient-to-br from-emerald-50/60 to-white">
                <h2 class="font-serif text-base md:text-lg font-bold text-gray-900 leading-tight">{{ $category->name }}</h2>
                @if($category->subtitle)
                <p class="text-xs md:text-sm text-gray-500 mt-0.5">{{ $category->subtitle }}</p>
                @endif
            </div>
            @endif

            <div class="px-5 md:px-6 py-6 md:py-7">
                <form method="POST" action="{{ route('customer.store') }}"
                      x-data="{ loading: false, submitted: false }"
                      @submit.prevent="if(!submitted){ submitted = true; loading = true; const $f = $el; const fd = new FormData($f); fetch($f.action, { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd }).then(r => r.json()).then(d => { if(d.redirect_url){ window.location.href = d.redirect_url; } else { submitted = false; loading = false; } }).catch(() => { submitted = false; loading = false; alert('Terjadi kesalahan. Silakan coba lagi.'); }); }">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="service_id" :value="serviceId">
                    <input type="hidden" name="item_title" :value="itemTitle">

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
                                <input type="tel" name="no_hp" required autocomplete="tel"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-300 text-sm focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition"
                                       placeholder="0812xxxxxxx">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" :disabled="loading"
                                    class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold rounded-full shadow-lg shadow-[#25D366]/25 hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 py-3 px-5 text-sm">
                                <span x-show="!loading" class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
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
        </div>
    </section>
</div>
@endsection