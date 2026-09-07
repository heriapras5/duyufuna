@extends('layouts.public')
@section('title', $article->seo_title ?: $article->title)
@section('meta_description', $article->seo_description ?: $article->excerpt)
@section('seo_keywords', $article->seo_keywords)
@section('og_type', 'article')
@section('og_image', $article->image)

@section('no_hero', true)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 md:pt-6 lg:pt-5 pb-10 max-w-7xl mx-auto">

    {{-- Kembali + Judul; subjudul & badge/tanggal sejajar judul (kolom sama) --}}
    <div class="mb-5 sm:mb-6">
        <div class="flex items-start gap-3 sm:gap-4">
            <a href="{{ route('articles.index') }}" title="Kembali ke Semua Artikel" class="shrink-0 w-7 h-7 md:w-8 md:h-8 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition border border-gray-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>
            <div class="min-w-0 flex-1">
                <h1 class="font-sans text-lg sm:text-xl md:text-2xl lg:text-3xl font-semibold leading-snug tracking-[-0.015em] text-gray-900 break-words">{{ $article->title }}</h1>
                @if($article->excerpt)
                <p class="mt-1 text-[13px] sm:text-base md:text-lg text-slate-500 leading-relaxed line-clamp-2">{{ $article->excerpt }}</p>
                @endif
                <div class="mt-2 flex flex-wrap items-center justify-start gap-x-4 gap-y-2">
                    @if($article->category)
                    <a href="{{ route('articles.category', $article->category->slug) }}" class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-semibold text-emerald-900 bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-200 leading-none hover:bg-emerald-200/70 transition truncate max-w-[200px]">{{ $article->category->name }}</a>
                    @endif
                    <span class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-semibold text-slate-600 whitespace-nowrap leading-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 shrink-0"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ optional($article->published_at)->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1.4fr_0.6fr] gap-6 md:gap-8 items-start">
        {{-- Kiri: Gambar + Isi Artikel + Bagikan --}}
        <div class="space-y-5 sm:space-y-6 min-w-0">

            {{-- Gambar Utama --}}
            @if($article->image && !str_ends_with($article->image, '.svg'))
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="relative aspect-[3/2] sm:aspect-[3/2] md:aspect-[16/10] lg:aspect-[16/9] w-full overflow-hidden bg-white">
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" width="800" height="450" loading="eager"
                         class="w-full h-full object-cover">
                </div>
            </div>
            @else
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="relative aspect-[3/2] sm:aspect-[3/2] md:aspect-[16/10] lg:aspect-[16/9] w-full overflow-hidden bg-gradient-to-br from-mint to-emerald-50 flex items-center justify-center">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-white/80 border border-emerald-100 shadow-sm flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-40"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </div>
                </div>
            </div>
            @endif

            {{-- Isi Artikel --}}
            <article class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 md:p-7 shadow-sm">
                <div class="article-content article-content--page text-justify hyphens-auto text-slate-600">
                    {!! $article->content !!}
                </div>
            </article>

            {{-- Bagikan artikel --}}
            @php
                $shareUrl = url()->current();
                $shareText = $article->title;
            @endphp
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 shadow-sm flex items-center gap-3">
                <p class="text-sm sm:text-[15px] font-semibold tracking-[-0.01em] text-gray-900">Bagikan artikel ini</p>
                <div class="flex items-center gap-2 ml-auto">
                    <a href="https://wa.me/?text={{ urlencode($shareText . ' - ' . $shareUrl) }}" target="_blank" rel="noreferrer" title="Bagikan via WhatsApp"
                       class="w-9 h-9 rounded-full bg-dark-green/10 flex items-center justify-center text-dark-green hover:bg-dark-green/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noreferrer" title="Bagikan via Facebook"
                       class="w-9 h-9 rounded-full bg-blue-600/10 flex items-center justify-center text-blue-700 hover:bg-blue-600/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($shareUrl) }}" target="_blank" rel="noreferrer" title="Bagikan via X"
                       class="w-9 h-9 rounded-full bg-slate-800/10 flex items-center justify-center text-slate-700 hover:bg-slate-800/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <button type="button"
                            x-data="{ copied: false }"
                            @click="navigator.clipboard.writeText('{{ $shareUrl }}').then(() => { copied = true; setTimeout(() => copied = false, 2000); })"
                            title="Salin link artikel"
                            class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition"
                            :class="copied ? '!bg-emerald-100 !text-emerald-700' : ''">
                        <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        <svg x-show="copied" x-cloak xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Kanan: Artikel Terkini (desktop: sticky) --}}
        <div class="lg:sticky lg:top-20 h-fit min-w-0">
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                <div class="px-4 sm:px-5 md:px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">Artikel Terkini</p>
                </div>
                <div class="px-4 sm:px-5 md:px-6 py-5 sm:py-6">
                    @if($recentArticles->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentArticles as $recent)
                        <a href="{{ route('articles.show', $recent->slug) }}" class="flex gap-3 group">
                            @if($recent->image)
                            <img src="{{ Storage::url($recent->image) }}" alt="{{ $recent->title }}" width="48" height="48" loading="lazy" class="w-12 h-12 rounded-xl object-cover shrink-0 ring-1 ring-gray-100">
                            @else
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-mint to-dark-green/5 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-30"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-gray-900 line-clamp-2 group-hover:text-dark-green transition-colors">{{ $recent->title }}</p>
                                <p class="text-[10px] text-gray-400 mt-1">{{ $recent->published_at ? $recent->published_at->format('d M Y') : '' }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-xs text-gray-400">Belum ada artikel lain.</p>
                    @endif
                    <a href="{{ route('articles.index') }}" class="mt-5 inline-flex items-center gap-1 text-gold text-xs font-medium hover:text-amber-500 transition group">
                        Lihat semua artikel
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-0.5 transition-transform"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
