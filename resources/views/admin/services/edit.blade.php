@extends('layouts.admin')
@section('title', 'Edit Layanan - ' . $service->title)
@section('page_title', 'Edit Layanan')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.categories.show', $service->category_id) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <input type="hidden" name="category_id" value="{{ $service->category_id }}">
        <div class="space-y-6">
            <x-admin.form-card title="Informasi Dasar" description="Data utama layanan.">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                        <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm font-medium text-gray-600">
                            <span>{{ $service->category->icon }}</span> {{ $service->category->name }}
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">Kategori otomatis sesuai halaman Kategori Layanan.</p>
                    </div>
                    <div class="space-y-5">
                        <x-admin.input name="title" label="Nama Layanan" required :value="$service->title" />
                        <x-admin.slug-preview source="title" base="service" />
                    </div>
                    <x-admin.switch name="status" label="Tampilkan di halaman publik" :checked="$service->status" help="Nonaktifkan untuk menyembunyikan layanan sementara." />
                </div>
                <div class="mt-5 pt-5 border-t border-gray-100">
                    <x-admin.image-upload name="image" label="Gambar" :existing="$service->image" hint="Ditampilkan pada kartu layanan di halaman kategori. Format: JPG, PNG, WEBP. Maks 2MB." />
                </div>
                <div class="mt-5 pt-5 border-t border-gray-100">
                    <x-admin.emoji-input name="icon" label="Ikon Alternatif (emoji)" help="Ditampilkan jika layanan tidak memiliki gambar. Kosongkan untuk memakai ikon kategori." :value="old('icon', $service->icon)" />
                </div>
            </x-admin.form-card>

            <x-admin.form-card title="Deskripsi" description="Satu deskripsi lengkap layanan." tone="amber">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/></svg>
                </x-slot:icon>
                <x-admin.summernote name="description" label="Deskripsi" :value="old('description', $service->description)" />
            </x-admin.form-card>

            @if($service->category?->isCatalog())
            <x-admin.form-card title="Sub-Layanan Katalog" description="Kategori ini dikelola sebagai katalog — sub-layanan dikelola per grup." tone="blue">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                </x-slot:icon>
                <div class="flex items-start gap-3 bg-sky-50 border border-sky-200 rounded-xl p-4 text-sm text-sky-800">
                    <div class="flex-1">
                        <p class="font-semibold">{{ $service->category->name }} adalah kategori katalog</p>
                        <p class="text-sky-700 mt-0.5">Sub-layanan ({{ $service->category->itemLabel() }}) pada {{ $service->category->groupLabel() }} ini dikelola melalui menu Katalog.</p>
                    </div>
                    <a href="{{ route('admin.catalog.items', [$service->category, $service]) }}" class="btn btn-secondary btn-sm shrink-0">Buka Item Katalog</a>
                </div>
            </x-admin.form-card>
            @endif

            <x-admin.form-card title="Pengaturan Pesan" description="Nomor HP dan teks pesan untuk tombol order layanan." tone="green">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                </x-slot:icon>
                <div class="max-w-lg space-y-5">
                    <x-admin.input name="whatsapp" label="No WhatsApp" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor default dari pengaturan." :value="$service->whatsapp" />
                    <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="$service->wa_message"
                        help="Kosongkan untuk memakai pesan default dari Pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}. {item} otomatis terisi nama sub-layanan yang dipilih pengunjung." />
                    <x-admin.wa-preview name="wa_message"
                        :number="$service->whatsapp"
                        :sample="['kategori' => $service->category?->name ?? '', 'layanan' => $service->title, 'item' => $service->title]" />
                </div>
            </x-admin.form-card>

            <x-admin.form-card title="SEO" description="Meta informasi untuk mesin pencari (opsional).">
                <div class="space-y-5">
                    <x-admin.input name="meta_title" label="Meta Title" placeholder="Judul untuk mesin pencari" :value="old('meta_title', $service->meta_title)" />
                    <x-admin.textarea name="meta_description" label="Meta Description" rows="2" placeholder="Ringkasan singkat untuk hasil pencarian" :value="old('meta_description', $service->meta_description)" />
                    <x-admin.input name="meta_keywords" label="Meta Keywords" placeholder="Kata kunci, pisahkan dengan koma" :value="old('meta_keywords', $service->meta_keywords)" />
                </div>
            </x-admin.form-card>

            <x-admin.form-actions cancel-url="{{ route('admin.categories.show', $service->category_id) }}" submit-label="Simpan Data" />
        </div>
    </form>
</div>
@endsection