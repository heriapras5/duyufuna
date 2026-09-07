@extends('layouts.public')
@section('title', isset($category) ? $category->name . ' - Artikel' : 'Artikel')
@section('meta_description', isset($category) ? 'Artikel ' . $category->name . ' seputar umroh dan haji' : 'Artikel seputar umroh dan haji terbaru')

@section('no_hero', true)
@section('breadcrumb', isset($category) ? $category->name : 'Artikel')

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 pb-10 md:pt-6 md:pb-12 max-w-7xl mx-auto">
    <div class="mb-6 md:mb-8">
        <h1 class="font-serif text-xl md:text-3xl font-bold text-gray-900">{{ isset($category) ? $category->name : ($globalSetting->artikel_page_title ?? 'Artikel & Panduan') }}</h1>
        <p class="text-sm md:text-base text-gray-500 mt-1">
            @if(isset($category))
            {{ $articles->total() }} artikel dalam kategori {{ $category->name }} seputar umroh dan haji
            @else
            {{ $globalSetting->artikel_page_subtitle ?? 'Informasi dan panduan seputar umroh dan haji' }}
            @endif
        </p>
    </div>
    @if(isset($categories) && $categories->count() > 0)
    <div class="mb-8 -mx-4 md:mx-0 px-4 md:px-0 overflow-x-auto pb-1 scrollbar-none">
        <div class="flex flex-nowrap gap-2 w-max">
            <a href="{{ route('articles.index') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap transition-all shrink-0 {{ !isset($category) ? 'bg-dark-green text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-mint' }}">
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('articles.category', $cat->slug) }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap transition-all shrink-0 {{ isset($category) && $category->id === $cat->id ? 'bg-dark-green text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-mint' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($articles->count() > 0)
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 stagger-children scroll-reveal">
        @foreach($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="relative card-glass-gold rounded-2xl overflow-hidden group">
            @if($article->image)
            <div class="relative h-48 md:h-52 overflow-hidden">
                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" loading="lazy" width="400" height="208" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>
            @else
            <div class="relative h-48 md:h-52 bg-gradient-to-br from-mint to-dark-green/5 overflow-hidden">
                <div class="absolute inset-0 islamic-pattern-light"></div>
                <div class="relative h-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="opacity-20"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
            </div>
            @endif
            @if($article->category)
            <span class="absolute top-3 left-3 z-10 inline-flex items-center gap-1.5 bg-gold text-white text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">{{ $article->category->name }}</span>
            @endif
            <div class="p-5 md:p-6">
                <p class="text-[11px] text-slate-500 font-medium mb-2 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ optional($article->published_at)->format('d M Y') }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 tabular-nums" title="Jumlah dibaca">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        {{ number_format($article->views, 0, ',', '.') }}
                    </span>
                </p>
                <h2 class="text-sm md:text-base font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-dark-green transition-colors">{{ $article->title }}</h2>
                @if($article->excerpt)
                <p class="text-xs text-slate-600 mt-2 leading-relaxed line-clamp-2">{{ $article->excerpt }}</p>
                @endif
                <div class="mt-4 flex items-center text-gold text-xs font-semibold gap-1 group-hover:gap-2 transition-all">
                    Baca Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-10">{{ $articles->links('vendor.pagination.public') }}</div>
    @else
    <div class="text-center py-20 card-glass-gold rounded-2xl p-8">
        <p class="text-gray-400 text-sm">Belum ada artikel tersedia.</p>
    </div>
    @endif
</div>
@endsection
