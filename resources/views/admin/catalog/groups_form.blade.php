@extends('layouts.admin')
@section('title', ($service->exists ? 'Edit ' : 'Tambah ') . $category->groupLabel())
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', $service->exists ? 'Edit ' . Str::lower($category->groupLabel()) : 'Tambah ' . Str::lower($category->groupLabel()) . ' baru')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.catalog.groups', $category) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ $service->exists
        ? route('admin.catalog.groups.update', [$category, $service])
        : route('admin.catalog.groups.store', $category) }}" enctype="multipart/form-data">
        @csrf
        @if($service->exists) @method('PUT') @endif

        <x-admin.form-card title="{{ $service->exists ? 'Edit ' : 'Tambah ' }}{{ $category->groupLabel() }}"
                           description="Data utama {{ Str::lower($category->groupLabel()) }}. Field di luar ini tidak diperlukan untuk katalog.">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
            </x-slot:icon>
            <div class="space-y-5">
                <x-admin.input name="title" label="Nama {{ $category->groupLabel() }}" required placeholder="{{ $category->groupPlaceholder() }}" :value="old('title', $service->title)" />
                @if($service->exists)
                <x-admin.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Nonaktif']" :selected="(int) old('status', $service->status)" />
                @endif
            </div>
            @if(!$service->exists)
            <input type="hidden" name="status" value="1">
            @endif
            <div class="mt-5 pt-5 border-t border-gray-100">
                <x-admin.image-upload name="image" label="Gambar" :existing="$service->image" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
            </div>
            <div class="mt-6">
                <x-admin.textarea name="short_description" label="Deskripsi Singkat (tampilan kartu {{ Str::lower($category->groupLabel()) }})" rows="2" maxlength="255" placeholder="Teks singkat yang tampil pada kartu {{ Str::lower($category->groupLabel()) }} di halaman publik" :value="old('short_description', $service->short_description)" help="Maksimal 255 karakter. Jika kosong, kartu akan menampilkan potongan dari Deskripsi." />
            </div>
            <div class="mt-6">
                <x-admin.summernote name="description" label="Deskripsi" :value="old('description', $service->description)" :height="140" />
            </div>
            <div class="mt-6">
                <x-admin.form-card title="Pengaturan Pesan" description="Nomor HP dan teks pesan untuk tombol konsultasi {{ Str::lower($category->groupLabel()) }} ini." tone="green">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                    </x-slot:icon>
                    <div class="max-w-lg space-y-5">
                        <x-admin.input name="whatsapp" label="No WhatsApp" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari kategori / pengaturan." :value="old('whatsapp', $service->whatsapp)" />
                        <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message', $service->wa_message)"
                            help="Kosongkan untuk memakai pesan dari kategori / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}. {item} otomatis terisi nama {{ Str::lower($category->itemLabel()) }} yang dipilih pengunjung." />
                        <x-admin.wa-preview name="wa_message"
                            :number="$service->whatsapp"
                            :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => '']" />
                    </div>
                </x-admin.form-card>
            </div>
            <div class="mt-6">
                <x-admin.form-actions cancel-url="{{ route('admin.catalog.groups', $category) }}" submit-label="Simpan" />
            </div>
        </x-admin.form-card>
    </form>
</div>
@endsection