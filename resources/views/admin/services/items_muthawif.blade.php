@extends('layouts.admin')
@section('title', $service->title . ' - ' . $category->name)
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Kelola daftar ' . Str::lower($category->item_label ?? 'item'))
@section('content')
<div>
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">Edit Layanan</a>
            <a href="{{ route('admin.services.items.create', $service) }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah {{ $category->item_label ?? 'Item' }}
            </a>
        </div>
    </div>

    {{-- Daftar Muthawif --}}
    @if($service->serviceItems->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach($service->serviceItems as $item)
        <div class="flex flex-col bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-emerald-100 transition group overflow-hidden">
            <div class="relative h-36 bg-gray-50">
                @if($item->image)
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                @elseif(is_array($item->gallery) && count($item->gallery) > 0)
                <img src="{{ Storage::url($item->gallery[0]) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                @endif
                <div class="absolute top-3 right-3">
                    <x-admin.status-toggle resource="service_items" :id="$item->id" :checked="$item->status" />
                </div>
            </div>

            <div class="p-5 flex flex-col flex-1">
                <h3 class="font-bold text-gray-900 text-base leading-snug break-words">{{ $item->title }}</h3>
                @if(trim((string) ($item->tagline ?? '')) !== '')
                <p class="mt-1.5 text-xs text-gray-500 leading-relaxed">{{ $item->tagline }}</p>
                @endif
                @if($item->info)
                <p class="mt-1.5 text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $item->info }}</p>
                @endif
                @if($item->price_per_night !== null)
                <p class="mt-2 text-sm font-bold text-emerald-600">SAR {{ number_format((float) $item->price_per_night, 0, ',', '.') }}</p>
                @endif
                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-end gap-1">
                    <a href="{{ route('admin.services.items.edit', $item) }}" title="Edit"
                       class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    </a>
                    <button type="button" onclick="confirmDelete('{{ route('admin.services.items.destroy', $item) }}')" title="Hapus"
                            class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <x-admin.card>
        <div class="text-center py-8">
            <p class="text-sm font-semibold text-gray-500">Belum ada {{ Str::lower($category->item_label ?? 'item') }}</p>
            <p class="text-xs text-gray-400 mt-1">Klik tombol <span class="font-semibold">Tambah {{ $category->item_label ?? 'Item' }}</span> di pojok kanan atas untuk menambahkan yang pertama.</p>
        </div>
    </x-admin.card>
    @endif
</div>
@endsection
