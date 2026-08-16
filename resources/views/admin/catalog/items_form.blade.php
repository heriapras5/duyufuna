@extends('layouts.admin')
@section('title', 'Edit ' . $category->itemLabel())
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Edit ' . Str::lower($category->itemLabel()) . ' "' . $item->title . '" pada "' . $service->title . '"')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.catalog.items', [$category, $service]) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.catalog.items.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-admin.form-card title="Edit {{ $category->itemLabel() }}"
                           description="Perbarui data {{ Str::lower($category->itemLabel()) }} di bawah ini lalu simpan.">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
            </x-slot:icon>
            <div class="space-y-5">
                <x-admin.input name="title" label="Nama {{ $category->itemLabel() }}" required placeholder="{{ $category->itemPlaceholder() }}" :value="old('title', $item->title)" />

                <x-admin.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Nonaktif']" :selected="old('status', $item->status)" />
            </div>

            <div class="mt-5 pt-5 border-t border-gray-100">
                <x-admin.image-upload name="image" label="Gambar" :existing="$item->image" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
            </div>

            <div class="mt-6">
                <x-admin.summernote name="description" label="Deskripsi" :value="old('description', $item->description)" :height="200" />
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <x-admin.form-card title="Pengaturan Pesan" description="Nomor HP dan teks pesan untuk tombol konsultasi {{ Str::lower($category->itemLabel()) }} ini." tone="green">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                    </x-slot:icon>
                    <div class="max-w-lg space-y-5">
                        <x-admin.input name="whatsapp" label="No WhatsApp" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari grup / pengaturan." :value="old('whatsapp', $item->whatsapp)" />
                        <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message', $item->wa_message)"
                            help="Kosongkan untuk memakai pesan dari grup / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}. {item} otomatis terisi nama {{ Str::lower($category->itemLabel()) }} yang dipilih pengunjung." />
                        <x-admin.wa-preview name="wa_message"
                            :number="$item->whatsapp ?: $service->whatsapp"
                            :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => $item->title]" />
                    </div>
                </x-admin.form-card>
            </div>

            <div class="mt-6">
                <x-admin.form-actions cancel-url="{{ route('admin.catalog.items', [$category, $service]) }}" submit-label="Simpan Data" />
            </div>
        </x-admin.form-card>
    </form>
</div>
@endsection