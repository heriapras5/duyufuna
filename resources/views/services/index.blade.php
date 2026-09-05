@extends('layouts.public')
@section('title', 'Layanan')
@section('meta_description', 'Daftar lengkap layanan umroh dan haji di DUYUFUNA')

@section('no_hero', true)
@section('breadcrumb', 'Layanan')

@section('content')
<div class="px-4 md:px-6 lg:px-8 pt-6 pb-12 md:pt-10 md:pb-16 max-w-7xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('home') }}" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-600 transition shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-gradient-to-br from-mint to-emerald-50 flex items-center justify-center text-base md:text-xl shadow-lg shrink-0 ring-1 ring-emerald-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <div>
                <h1 class="font-serif text-sm md:text-xl lg:text-2xl font-bold text-gray-900">{{ $globalSetting->services_page_title ?? 'Layanan Kami' }}</h1>
                <p class="text-gray-500 text-xs md:text-sm mt-0.5">{{ $globalSetting->services_page_subtitle ?? 'Daftar lengkap layanan umroh dan haji' }}</p>
            </div>
        </div>
    </div>
    <div class="mb-8 flex flex-col sm:flex-row gap-3" x-data="{ q: '{{ request('q') }}', category: '{{ request('category') }}' }">
        <div class="relative flex-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" x-model="q" placeholder="Cari layanan..." @input.debounce.500ms="window.location = '{{ route('services.index') }}?q=' + q + (category ? '&category=' + category : '')" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition text-sm">
        </div>
        <select x-model="category" @change="window.location = '{{ route('services.index') }}?category=' + category + (q ? '&q=' + q : '')" class="w-full sm:w-48 px-4 py-3 rounded-xl border border-gray-200 bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition text-sm text-gray-600">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    @if($services->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-5 lg:gap-6">
        @foreach($services as $i => $service)
        @include('categories.partials.service-card', [
            'service' => $service,
            'index' => $i,
        ])
        @endforeach
    </div>
    <div class="mt-10">{{ $services->links() }}</div>
    @else
    <div class="text-center py-20 card-glass-gold rounded-2xl p-8">
        <p class="text-gray-400 text-sm">Layanan tidak ditemukan. Coba kata kunci lain.</p>
    </div>
    @endif
</div>
@endsection
