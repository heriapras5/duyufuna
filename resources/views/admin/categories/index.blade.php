@extends('layouts.admin')
@section('title', 'Kategori Layanan')
@section('page_title', 'Kategori Layanan')
@section('content')
<x-admin.search route="admin.categories.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.categories.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

@if($categories->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @foreach($categories as $cat)
    <div class="flex flex-col bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1.5 hover:border-emerald-300 hover:ring-1 hover:ring-emerald-200 transition-all duration-300 group">
        <div class="p-5 flex items-start gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center text-2xl shrink-0 ring-1 ring-emerald-200 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-emerald-200/50 transition-all duration-300">
                <span>{{ $cat->icon }}</span>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="font-bold text-gray-900 text-base truncate">{{ $cat->name }}</h3>
                @if($cat->subtitle)
                <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $cat->subtitle }}</p>
                @endif
            </div>
            <div class="flex items-center gap-1 shrink-0">
                <x-admin.actions edit="admin.categories.edit" destroy="admin.categories.destroy" :params="[$cat]" />
            </div>
        </div>
        <div class="px-5 py-4 mt-auto border-t border-gray-50 flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
                    {{ $cat->services_count }} {{ Str::lower($cat->groupLabel()) }}
                </span>
            </div>
            <a href="{{ route('admin.categories.show', $cat) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-gold hover:text-amber-500 transition shrink-0">
                Kelola {{ $cat->groupLabel() }}
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </div>
    @endforeach
</div>
@else
<x-admin.card>
    <div class="text-center py-6">
        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2"/></svg>
        </div>
        <p class="text-gray-400 text-sm mb-4">{{ request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada kategori. Buat kategori pertama Anda.' }}</p>
    </div>
</x-admin.card>
@endif
@endsection
