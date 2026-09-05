@extends('layouts.public')

@section('title', $category->meta_title ?: $category->name)
@section('meta_description', $category->meta_description ?: 'Layanan ' . $category->name . ' di DUYUFUNA')
@section('seo_keywords', $category->meta_keywords)
@section('og_image', $items->first()?->image)

@section('no_hero', true)

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-16 max-w-7xl mx-auto space-y-6"
     x-data="">
    <div class="flex items-start gap-3 sm:gap-4 mb-8">
        <a href="{{ route('home') }}" class="mt-[1px] w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-600 transition shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="min-w-0 flex-1">
            <h1 class="font-sans text-base sm:text-lg md:text-xl font-bold text-gray-900 leading-tight">{{ $category->name }}</h1>
            @if($category->subtitle)
            <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $category->subtitle }}</p>
            @endif
        </div>
    </div>

    @if($items->count() > 0)
    <section>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-8">
            @foreach($items as $item)
            @include('categories.partials.visa-card', [
                'item' => $item,
                'service' => $item->service,
                'category' => $category,
            ])
            @endforeach
        </div>
        <div class="mt-10">{{ $items->links() }}</div>
    </section>
    @else
    <div class="text-center py-10 card-glass-gold rounded-2xl p-6">
        <p class="text-gray-400 text-sm">Segera Hadir</p>
        <p class="text-gray-300 text-xs mt-1">Konten untuk kategori ini sedang dipersiapkan.</p>
    </div>
    @endif
</div>
@endsection

@push('modals')
    @include('categories.partials.modal-consult')
@endpush