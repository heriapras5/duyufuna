@extends('layouts.admin')
@section('title', $category->name)
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Kelola ' . strtolower($category->groupLabel()) . ' dalam katalog ini')
@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
            Edit Kategori
        </a>
        <a href="{{ route('admin.catalog.groups.create', $category) }}" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah {{ $category->groupLabel() }}
        </a>
    </div>
</div>

@if($services->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @foreach($services as $svc)
    <div class="flex flex-col bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-emerald-100 transition group overflow-hidden">
        <div class="relative h-36 bg-gray-50">
            @if($svc->image)
            <img src="{{ Storage::url($svc->image) }}" alt="{{ $svc->title }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute top-3 right-3">
                <x-admin.status-toggle resource="services" :id="$svc->id" :checked="$svc->status" />
            </div>
        </div>
        <div class="p-5 flex flex-col flex-1">
            <h3 class="font-bold text-gray-900 text-base truncate">{{ $svc->title }}</h3>
            @if($svc->description)
            <div class="mt-1.5 pt-1.5 border-t border-gray-100 border-dashed">
                <p class="text-xs text-gray-500 line-clamp-3">{!! Str::limit(strip_tags($svc->description), 100) !!}</p>
            </div>
            @endif
            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between gap-3">
                <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2v6a6 6 0 0 0 10 4.46"/><path d="M18 2v6a6 6 0 0 1-6 6"/><path d="M10 14v8"/><path d="M14 14v8"/><path d="M12 2v8"/></svg>
                    {{ $svc->service_items_count }} {{ Str::lower($category->itemLabel()) }}
                </span>
                <div class="flex items-center gap-1 shrink-0">
                    <a href="{{ route('admin.catalog.items', [$category, $svc]) }}" title="Kelola item"
                       class="inline-flex items-center gap-1 text-xs font-semibold text-gold hover:text-amber-500 transition">
                        Kelola
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('admin.catalog.groups.edit', [$category, $svc]) }}" title="Edit"
                       class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                    </a>
                    <button type="button" onclick="confirmDelete('{{ route('admin.catalog.groups.destroy', [$category, $svc]) }}')" title="Hapus"
                            class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<x-admin.card>
    <div class="text-center py-10">
        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
        </div>
        <p class="text-gray-400 text-sm mb-4">Belum ada {{ Str::lower($category->groupLabel()) }} di kategori ini.</p>
        <a href="{{ route('admin.catalog.groups.create', $category) }}" class="btn btn-primary inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah {{ $category->groupLabel() }}
        </a>
    </div>
</x-admin.card>
@endif
@endsection