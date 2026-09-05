@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf @method('PUT')
        <div class="space-y-6">
            <x-admin.form-card title="Info Kategori" description="Data utama kategori layanan.">
                <div class="space-y-5">
                    <x-admin.input name="name" label="Nama" required placeholder="Contoh: Haji & Umroh" :value="$category->name" />
                    <x-admin.slug-preview source="name" base="category" />
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.emoji-input name="icon" label="Ikon (emoji)" :value="$category->icon" help="Pilih dari daftar emoji sesuai tema, atau ketik manual." />
                        <x-admin.input name="sort" label="Urutan" type="number" placeholder="0" :value="$category->sort ?? 0" help="Angka kecil tampil lebih dulu." />
                    </div>
                    @unless(in_array($category->slug, ['hotel', 'laundry', 'buggy-car', 'kursi-roda-umroh']))
                    <x-admin.input name="subtitle" label="Subtitle" placeholder="Satu kalimat singkat penjelas" :value="$category->subtitle" />
                    @endunless
                    <div class="pt-5 mt-5 border-t border-gray-100 space-y-5" x-data="{ pageType: '{{ old('page_type', $category->page_type ?? 'cards') }}' }">
                        <x-admin.mode-picker model="pageType" name="page_type" />
                        <div x-show="pageType === 'catalog'" class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <x-admin.input name="group_label" label="Label Grup" placeholder="Contoh: Paket" help="Nama kolektif untuk grup layanan. Default: Grup" :value="old('group_label', $category->group_label)" />
                            <x-admin.input name="item_label" label="Label Item" placeholder="Contoh: Produk" help="Nama kolektif untuk item per grup. Default: Item" :value="old('item_label', $category->item_label)" />
                        </div>
                    </div>
                </div>
            </x-admin.form-card>

            @if(!in_array($category->slug, ['jastip-viral', 'catering']))
            @if(!in_array($category->slug, ['jastip-viral', 'catering', 'hotel', 'laundry', 'buggy-car', 'kursi-roda-umroh', 'fotografer', 'penukaran-uang', 'muthawif']))
            <x-admin.form-card title="Deskripsi" description="Teks ini tampil di halaman publik kategori.">
                <x-admin.summernote name="description" label="Deskripsi" :value="old('description', $category->description)" />
            </x-admin.form-card>
            @endif
            @endif

            <x-admin.form-card title="WhatsApp (Opsional)" description="Nomor & pesan khusus untuk konsultasi di kategori ini. Kosongkan untuk memakai pengaturan global.">
                <div class="space-y-5">
                    <x-admin.input name="whatsapp" label="No WhatsApp" placeholder="6281293679502" :value="old('whatsapp', $category->whatsapp)"
                        help="Format internasional tanpa +. Contoh: 6281293679502. Kosongkan untuk memakai nomor global." />
                    <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message', $category->wa_message)"
                        help="Pesan khusus untuk semua layanan di kategori ini. Kosongkan untuk memakai pesan global. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {item}, {website}, {tanggal}." />
                    <x-admin.wa-preview name="wa_message" title-source="name"
                        :number="$category->whatsapp"
                        :sample="['kategori' => $category->name, 'layanan' => $category->name, 'item' => $category->name]" />
                </div>
            </x-admin.form-card>

            <x-admin.form-actions cancel-url="{{ route('admin.categories.index') }}" submit-label="Simpan Data" />
        </div>
    </form>
</div>
@endsection
