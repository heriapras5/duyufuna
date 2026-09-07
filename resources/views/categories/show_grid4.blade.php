@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)
@section('og_image', $items->first()?->image)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-5 pb-10 md:pt-6 md:pb-12 max-w-7xl mx-auto space-y-4 sm:space-y-6"
     x-data="">
    <div class="flex items-center gap-3 sm:gap-4">
        <a href="{{ route('home') }}" class="w-7 h-7 md:w-8 md:h-8 rounded-xl bg-white hover:bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-600 transition shrink-0 border border-slate-200/60 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="min-w-0">
            <h1 class="font-serif text-base sm:text-lg md:text-xl font-bold text-gray-900 leading-tight break-words">{{ $category->name }}</h1>
            @if($category->subtitle)
            <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
            @endif
        </div>
    </div>

    @if($category->description)
    <section>
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-gray-100/80 shadow-sm">
            <div class="article-content text-[13px] md:text-sm text-gray-600 leading-relaxed">{!! $category->description !!}</div>
        </div>
    </section>
    @endif

    <section>
        @if($items->count() > 0)
        <div class="rounded-2xl bg-white border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-4 md:px-5 pt-4 pb-3 border-b border-dashed border-gray-100 bg-gradient-to-br from-emerald-50/60 to-white">
                <h2 class="font-serif text-sm md:text-base font-bold text-gray-900 leading-tight">Pilih {{ $category->itemLabel() ?: $category->name }}</h2>
                <p class="text-[11px] md:text-xs text-gray-500 mt-0.5">Klik Detail untuk informasi lengkap, atau Hubungi untuk konsultasi via WhatsApp.</p>
            </div>
            <div class="p-3 sm:p-4 md:p-5 bg-slate-50/40 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($items as $item)
                @include('categories.partials.item-grid-card', [
                    'item' => $item,
                    'service' => $item->service,
                    'category' => $category,
                    'index' => $loop->index,
                    'badge' => $category->slug === 'catering' ? $item->service->title : null,
                ])
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-10 card-glass-gold rounded-2xl p-6">
            <p class="text-gray-400 text-sm">Segera Hadir</p>
            <p class="text-gray-300 text-xs mt-1">Konten untuk kategori ini sedang dipersiapkan.</p>
        </div>
        @endif
    </section>
</div>

@push('modals')
    @include('categories.partials.modal-detail')
    @include('categories.partials.modal-consult')
@endpush
@endsection
