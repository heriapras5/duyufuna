@extends('layouts.admin')
@section('title', $service->title . ' - ' . $category->name)
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Kelola ' . Str::lower($category->itemLabel()) . ' untuk "' . $service->title . '"')
@section('content')
<div x-data="{ showAdd: false }">
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <a href="{{ route('admin.catalog.groups', $category) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.catalog.groups.edit', [$category, $service]) }}" class="btn btn-secondary btn-sm">Edit {{ $service->title }}</a>
        <button type="button" @click="showAdd = !showAdd" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah {{ $category->itemLabel() }}
        </button>
    </div>
</div>

<div x-show="showAdd" x-cloak x-transition class="mb-6">
    <form method="POST" action="{{ route('admin.catalog.items.store', [$category, $service]) }}" enctype="multipart/form-data">
        @csrf
        <x-admin.form-card title="Tambah {{ $category->itemLabel() }} Baru" description="Lengkapi data di bawah ini lalu simpan." tone="green">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </x-slot:icon>
            <div class="max-w-xl space-y-5">
                <x-admin.input name="title" label="Nama {{ $category->itemLabel() }}" required placeholder="Contoh: {{ $category->itemLabel() }} A / B / C" :value="old('title')" />
                <x-admin.image-upload name="image" label="Gambar" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                <x-admin.input name="whatsapp" label="No WhatsApp (opsional)" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari grup / pengaturan." :value="old('whatsapp')" />
                <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp (opsional)" rows="3" :value="old('wa_message')"
                    help="Kosongkan untuk memakai pesan dari grup / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}." />
                <x-admin.wa-preview name="wa_message"
                    :number="$service->whatsapp"
                    :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => $category->itemLabel() . ' A']" />
            </div>
            <div class="mt-5">
                <x-admin.summernote name="description" label="Deskripsi" :value="old('description')" :height="140" />
            </div>
            <div class="flex justify-end gap-3 mt-5">
                <button type="button" @click="showAdd = false" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </x-admin.form-card>
    </form>
</div>

@if($service->serviceItems->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @foreach($service->serviceItems as $item)
    <div class="flex flex-col bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-emerald-100 transition group overflow-hidden">
        <div class="relative h-36 bg-gray-50">
            @if($item->image)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute top-3 right-3">
                <x-admin.status-toggle resource="service_items" :id="$item->id" :checked="$item->status" />
            </div>
        </div>

        <div class="p-5 flex flex-col flex-1">
            <h3 class="font-bold text-gray-900 text-base truncate">{{ $item->title }}</h3>
            @if($item->description)
            <div class="mt-1.5 pt-1.5 border-t border-gray-100 border-dashed">
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">{!! Str::limit(strip_tags($item->description), 140) !!}</p>
            </div>
            @endif
            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-end gap-1">
                <a href="{{ route('admin.catalog.items.edit', $item) }}"
                        title="Edit"
                        class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                </a>
                <button type="button" onclick="confirmDelete('{{ route('admin.catalog.items.destroy', $item) }}')" title="Hapus"
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
    <div class="text-center py-10">
        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
        </div>
        <p class="text-gray-400 text-sm mb-4">Belum ada {{ Str::lower($category->itemLabel()) }} pada "{{ $service->title }}".</p>
        <button type="button" @click="showAdd = true" class="btn btn-primary inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah {{ $category->itemLabel() }}
        </button>
    </div>
</x-admin.card>
@endif
</div>
@endsection