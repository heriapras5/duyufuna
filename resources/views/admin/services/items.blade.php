@extends('layouts.admin')
@section('title', $service->title . ' - ' . $category->name)
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Kelola ' . Str::lower($category->itemLabel()) . ' untuk "' . $service->title . '"')
@section('content')
<div>
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">Edit {{ $service->title }}</a>
    </div>
</div>

<div class="mb-6">
    <form method="POST" action="{{ route('admin.services.items.store', $service) }}" enctype="multipart/form-data">
        @csrf
        <x-admin.form-card title="Tambah {{ $category->itemLabel() }} Baru" description="Lengkapi data di bawah ini lalu simpan." tone="green">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </x-slot:icon>
            <div class="max-w-5xl space-y-5">
                <x-admin.input name="title" label="Nama {{ $category->itemLabel() }}" required placeholder="Contoh: Tawaf, Sa'i, Paket 1–5 kg" :value="old('title')" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-admin.input name="price" type="number" step="1" min="0" label="Harga (SAR)" placeholder="cth: 110" :value="old('price')" help="Harga dalam Riyal Saudi. Kosongkan jika belum ada." />
                </div>
                <x-admin.textarea name="info" label="Info Singkat" rows="2" :value="old('info')" placeholder="Contoh: Waktu pengerjaan ± 24 jam · Antar-jemput ke kamar hotel" help="Teks singkat yang tampil di kartu pemilih." />
                <x-admin.image-upload name="image" label="Gambar" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                <x-admin.gallery-upload name="gallery" label="Galeri Kegiatan" :existing="[]" hint="Unggah 4 foto per kegiatan (maks 8). Format: JPG, PNG, WEBP. Maks 2MB per file." />
                <x-admin.input name="whatsapp" label="No WhatsApp (opsional)" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari layanan / pengaturan." :value="old('whatsapp')" />
                <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp (opsional)" rows="3" :value="old('wa_message')"
                    help="Kosongkan untuk memakai pesan dari layanan / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}." />
                <x-admin.wa-preview name="wa_message"
                    :number="$service->whatsapp"
                    :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => $category->itemLabel() . ' Baru']" />
            </div>
            <div class="flex justify-end gap-3 mt-5">
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
            @elseif(is_array($item->gallery) && count($item->gallery) > 0)
            <img src="{{ Storage::url($item->gallery[0]) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
            @endif
            @if(is_array($item->gallery) && count($item->gallery) > 0)
            <span class="absolute bottom-3 left-3 inline-flex items-center gap-1 rounded-full bg-black/55 text-white text-[11px] font-semibold px-2.5 py-1 backdrop-blur">
                📷 {{ count($item->gallery) }} foto
            </span>
            @endif
            <div class="absolute top-3 right-3">
                <x-admin.status-toggle resource="service_items" :id="$item->id" :checked="$item->status" />
            </div>
        </div>

        <div class="p-5 flex flex-col flex-1">
            <div class="flex items-center justify-between gap-2">
                <h3 class="font-bold text-gray-900 text-base truncate">{{ $item->title }}</h3>
            </div>
            @if($item->price_per_night !== null)
            <p class="mt-1 text-xs font-semibold text-emerald-600">SAR {{ number_format((float) $item->price_per_night, 0, ',', '.') }}</p>
            @endif
            @if($item->info)
            <div class="mt-1.5 pt-1.5 border-t border-gray-100 border-dashed">
                <p class="text-xs text-gray-500 leading-relaxed">{{ $item->info }}</p>
            </div>
            @endif
            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-end gap-1">
                <a href="{{ route('admin.services.items.edit', $item) }}"
                        title="Edit"
                        class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
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
@endif
</div>
@endsection