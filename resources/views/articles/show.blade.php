@extends('layouts.public')
@section('title', $article->seo_title ?: $article->title)
@section('meta_description', $article->seo_description ?: $article->excerpt)
@section('seo_keywords', $article->seo_keywords)

@section('no_hero', true)

@section('content')
<div class="px-4 md:px-6 lg:px-8 py-6 md:py-10 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-dark-green text-sm transition inline-flex items-center gap-1 mb-4 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-0.5 transition-transform"><path d="m15 18-6-6 6-6"/></svg>
                Semua Artikel
            </a>
            @if($article->image && !str_ends_with($article->image, '.svg'))
            <div class="relative rounded-2xl md:rounded-3xl overflow-hidden shadow-sm ring-1 ring-gray-100 mb-6">
                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" width="800" height="533" loading="lazy"
                     class="w-full aspect-[3/2] md:aspect-[16/10] object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
                @if($article->category)
                <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 bg-gold text-white text-[11px] font-semibold px-3 py-1 rounded-full shadow-md">{{ $article->category->name }}</span>
                @endif
            </div>
            @else
            <div class="mx-auto w-full max-w-md rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-mint to-emerald-50 border border-gray-100 flex items-center justify-center aspect-[16/9]">
                <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-white/80 border border-emerald-100 shadow-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-40"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
            </div>
            @endif
            <div class="mb-6">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    @if($article->category)
                    <a href="{{ route('articles.category', $article->category->slug) }}" class="inline-flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-wider text-gold bg-gold/10 border border-gold/20 px-2.5 py-1 rounded-full hover:bg-gold/20 transition">{{ $article->category->name }}</a>
                    @endif
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ optional($article->published_at)->format('d M Y') }}
                    </span>
                </div>
                <h1 class="font-serif text-xl md:text-3xl font-bold text-gray-900">{{ $article->title }}</h1>
                @if($article->excerpt)
                <p class="text-sm md:text-base text-gray-500 mt-2 leading-relaxed">{{ $article->excerpt }}</p>
                @endif
            </div>
            <article class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100/80 shadow-sm article-content">
                {!! $article->content !!}
            </article>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-gray-100/80 shadow-sm sticky top-24">
                <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Artikel Terkini
                </h3>
                @if($recentArticles->count() > 0)
                <div class="space-y-4">
                    @foreach($recentArticles as $recent)
                    <a href="{{ route('articles.show', $recent->slug) }}" class="flex gap-3 group">
                        @if($recent->image)
                        <img src="{{ Storage::url($recent->image) }}" alt="{{ $recent->title }}" width="56" height="56" loading="lazy" class="w-14 h-14 rounded-xl object-cover shrink-0 ring-1 ring-gray-100">
                        @else
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-mint to-dark-green/5 flex items-center justify-center shrink-0">
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
@endsection
