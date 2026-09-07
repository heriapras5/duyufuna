@extends('layouts.public')

@section('title', 'Testimoni')
@section('meta_description', 'Testimoni dan pengalaman nyata jamaah yang telah menggunakan layanan ' . ($globalSetting->website_name ?? 'DUYUFUNA') . '.')

@section('no_hero', true)

@section('content')
    <section class="px-4 md:px-6 lg:px-8 pt-5 pb-12 md:pt-8 md:pb-16 max-w-7xl mx-auto scroll-reveal">
        <div class="mb-6 md:mb-8 flex flex-wrap items-end justify-between gap-3">
            <div class="min-w-0">
                <h1 class="font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{!! $globalSetting->testimoni_page_title ?? 'Apa Kata <span class="text-dark-green">Jamaah</span>?' !!}</h1>
                <p class="text-sm md:text-base text-gray-500 mt-1 max-w-2xl">{{ $globalSetting->testimoni_page_subtitle ?? 'Pengalaman nyata dari jamaah yang telah menggunakan layanan kami.' }}</p>
            </div>
        </div>

        @if($testimonials->isNotEmpty())
        {{-- Grid seragam: 2 kolom mobile/tablet, 4 kolom desktop --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5 scroll-reveal">
@foreach($testimonials as $t)
            {{-- Kartu gaya handling: border bersih + header gradasi hijau + halo lembut --}}
            <div class="group h-full flex flex-col rounded-2xl border bg-white overflow-hidden border-slate-300 shadow-[0_10px_24px_rgba(15,23,42,0.06)] hover:border-emerald-500/60 hover:shadow-[0_14px_30px_rgba(5,92,59,0.10)] hover:-translate-y-0.5 active:scale-[0.99] transition-all duration-300">
                {{-- Header gambar: gradasi hijau muda + halo di belakang --}}
                <div class="relative p-2.5 border-b border-slate-100 bg-gradient-to-b from-emerald-50/50 to-white shrink-0">
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-20 h-20 rounded-full opacity-20 blur-2xl bg-emerald-400"></div>
                    @if($t->image)
                    <a href="{{ Storage::url($t->image) }}" data-fancybox="testimoni-galeri" data-caption="Screenshot chat {{ $t->name }}" target="_blank" rel="noreferrer" class="relative block">
                        <div class="w-full aspect-[3/4] rounded-xl overflow-hidden border border-slate-200 bg-white">
                            <img src="{{ Storage::url($t->image) }}" alt="Screenshot chat {{ $t->name }}" loading="lazy" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                        </div>
                    </a>
                    @else
                    <div class="relative w-full aspect-[3/4] rounded-xl border border-slate-200 bg-white flex items-center justify-center">
                        <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- Caption menempel di bawah kartu agar sejajar antar kartu --}}
                <div class="p-3 flex-1 flex flex-col justify-end text-center">
                    @if($t->name)
                    <p class="font-serif text-sm font-bold text-slate-950 leading-tight line-clamp-1">{{ $t->name }}</p>
                    @endif
                    @if($t->review)
                    <p class="mt-1.5 text-[13px] font-medium text-slate-700 leading-relaxed italic line-clamp-3">"{{ strip_tags($t->review) }}"</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-10">{{ $testimonials->links('vendor.pagination.public') }}</div>
        @else
        <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50/60 p-8 text-center">
            <div class="mx-auto w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <p class="text-gray-600 font-semibold">Belum ada testimoni.</p>
            <p class="text-gray-400 text-sm mt-1">Testimoni jamaah akan tampil di sini setelah ditambahkan.</p>
        </div>
        @endif
    </section>
@endsection
