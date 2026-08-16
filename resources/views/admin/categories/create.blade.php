@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('page_title', 'Tambah Kategori')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="space-y-6">
            <x-admin.form-card title="Info Kategori" description="Data utama kategori layanan.">
                <div class="space-y-5">
                    <x-admin.input name="name" label="Nama" required placeholder="Contoh: Haji & Umroh" :value="old('name')" />
                    <x-admin.slug-preview source="name" base="category" />
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.emoji-input name="icon" label="Ikon (emoji)" :value="old('icon')" help="Pilih dari daftar emoji sesuai tema, atau ketik manual." />
                        <x-admin.input name="sort" label="Urutan" type="number" placeholder="0" :value="old('sort')" help="Kosongkan untuk urutan otomatis. Angka kecil tampil lebih dulu." />
                    </div>
                    <x-admin.input name="subtitle" label="Subtitle" placeholder="Satu kalimat singkat penjelas" :value="old('subtitle')" />
                    <div class="pt-5 mt-5 border-t border-gray-100 space-y-5" x-data="{ isCatalog: false }">
                        <div x-show="isCatalog" class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <x-admin.input name="group_label" label="Label Grup" placeholder="Contoh: Paket" help="Nama kolektif untuk grup layanan. Default: Layanan" :value="old('group_label')" />
                            <x-admin.input name="item_label" label="Label Item" placeholder="Contoh: Produk" help="Nama kolektif untuk item per grup. Default: Item" :value="old('item_label')" />
                        </div>
                    </div>
                </div>
            </x-admin.form-card>

            <x-admin.form-card title="Deskripsi" description="Teks ini tampil di halaman publik kategori.">
                <x-admin.summernote name="description" label="Deskripsi" :value="old('description')" />
            </x-admin.form-card>

            <x-admin.form-card title="WhatsApp (Opsional)" description="Nomor & pesan khusus untuk konsultasi di kategori ini. Kosongkan untuk memakai pengaturan global.">
                <div class="space-y-5">
                    <x-admin.input name="whatsapp" label="No WhatsApp" placeholder="6281234567890" :value="old('whatsapp')"
                        help="Format internasional tanpa +. Contoh: 6281234567890. Kosongkan untuk memakai nomor global." />
                    <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message')"
                        help="Pesan khusus untuk semua layanan di kategori ini. Kosongkan untuk memakai pesan global. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {item}, {website}, {tanggal}." />
                    <x-admin.wa-preview name="wa_message" />
                </div>
            </x-admin.form-card>

            <x-admin.form-actions cancel-url="{{ route('admin.categories.index') }}" submit-label="Simpan" />
        </div>
    </form>
</div>
@endsection
