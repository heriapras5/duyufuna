@extends('layouts.public')

@section('title', 'FAQ')
@section('meta_description', 'Pertanyaan yang sering diajukan seputar layanan ' . ($globalSetting->website_name ?? 'DUYUFUNA') . '.')

@section('no_hero', true)
@section('breadcrumb', 'FAQ')

@section('content')
    <section class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-3xl mx-auto scroll-reveal">
        <div class="mb-6 md:mb-8">
            <h1 class="font-serif text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{!! $globalSetting->faq_page_title ?? 'Pertanyaan <span class="text-dark-green">Umum</span>' !!}</h1>
            <p class="text-sm md:text-base text-gray-500 mt-1">{{ $globalSetting->faq_page_subtitle ?? 'Jawaban atas pertanyaan yang paling sering diajukan.' }}</p>
        </div>
        @if($faqs->count() > 0)
        <div class="space-y-3 md:space-y-4 stagger-children scroll-reveal">
            @foreach($faqs as $f)
            <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white transition-all duration-300" x-data="{ open: false }" x-bind:class="open ? 'shadow-sm border-gold/30' : ''">
                <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-4 p-5 md:p-6 text-left">
                    <span class="flex items-center gap-3 font-bold text-slate-950 text-[15px] md:text-base leading-snug">
                        <span class="w-8 h-8 shrink-0 rounded-lg bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center text-gold text-xs font-bold ring-1 ring-gold/20">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        {{ $f->question }}
                    </span>
                    <span class="w-8 h-8 shrink-0 rounded-full bg-gray-50 flex items-center justify-center transition-transform duration-500 text-gray-500" x-bind:class="open ? 'rotate-180 text-gold' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </span>
                </button>
                <div x-show="open" x-collapse.duration.500ms class="border-t border-gray-50">
                    <div class="px-5 md:px-6 pb-5 md:pb-6">
                        <div class="pt-1 text-slate-700 text-sm md:text-[15px] leading-relaxed [&_p]:my-2 [&_ul]:list-disc [&_ul]:pl-5 [&_a]:text-dark-green [&_a]:underline">{!! $f->answer !!}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="mx-auto w-20 h-20 mb-4 rounded-2xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center ring-1 ring-gold/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/><circle cx="12" cy="12" r="10"/></svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada pertanyaan yang sering diajukan.</p>
        </div>
        @endif
    </section>
@endsection