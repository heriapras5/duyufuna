@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Daftar produk ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)

@section('no_hero', true)
@section('breadcrumb', $category->name)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-6 pb-12 md:pt-10 md:pb-16 max-w-7xl mx-auto space-y-8"
     x-data="">
    <div class="flex items-start gap-4">
        <a href="{{ route('home') }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-600 transition shrink-0 mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="flex items-center gap-4">
            @if($category->icon)
            <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-gradient-to-br from-mint to-emerald-50 flex items-center justify-center text-base md:text-xl shadow-lg shrink-0 ring-1 ring-emerald-200">
                <span>{{ $category->icon }}</span>
            </div>
            @endif
            <div>
                <h1 class="font-serif text-sm md:text-xl lg:text-2xl font-bold text-gray-900">{{ $category->name }}</h1>
                <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
            </div>
        </div>
    </div>

    @if($category->description)
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100/80 shadow-sm text-[13px] md:text-sm text-gray-600 leading-relaxed">
        {!! $category->description !!}
    </div>
    @endif

    @if($services->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 stagger-children scroll-reveal">
        @foreach($services as $service)
        @include('categories.partials.card', [
            'card' => $service,
            'service' => $service,
            'title' => $service->title,
            'description' => $service->short_description,
            'image' => $service->image,
            'subtext' => $service->duration,
        ])
        @endforeach
    </div>
    <div class="mt-10">{{ $services->links() }}</div>
    @else
    <div class="text-center py-10 card-glass-gold rounded-2xl p-6">
        <p class="text-gray-400 text-sm">Segera Hadir</p>
        <p class="text-gray-300 text-xs mt-1">Produk untuk kategori ini sedang dipersiapkan.</p>
    </div>
    @endif

</div>

@push('modals')
    @include('categories.partials.modal-detail')
    @include('categories.partials.modal-consult')
@endpush
@endsection
