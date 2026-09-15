@extends('layouts.admin')
@section('title', 'Tambah ' . $category->itemLabel())
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Tambah ' . Str::lower($category->itemLabel()) . ' baru pada "' . $service->title . '"')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.services.items', $service) }}" class="btn btn-secondary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.services.items.store', $service) }}" enctype="multipart/form-data">
        @csrf
        <x-admin.form-card title="Tambah {{ $category->itemLabel() }} Baru"
                           description="Lengkapi data di bawah ini lalu simpan." tone="green">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </x-slot:icon>
            <div class="space-y-5">
                <x-admin.input name="title" label="{{ $category->slug === 'laundry' ? 'Nama Paket' : 'Nama ' . $category->itemLabel() }}" required placeholder="{{ $category->itemPlaceholder() }}" :value="old('title')" />

                @if($category->slug === 'laundry')
                <x-admin.input name="tagline" label="Keterangan" placeholder="cth: 1-5 Kg" :value="old('tagline')"
                    help="Keterangan berat paket, tampil di bawah nama paket pada kartu publik." />
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-admin.input name="price" type="number" step="1" min="0" label="{{ $category->slug === 'muthawif' ? 'SAR' : 'Harga (SAR)' }}" :value="old('price')" help="Harga dalam Riyal Saudi. Kosongkan jika belum ada." />
                    <x-admin.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Nonaktif']" :selected="old('status', 1)" />
                </div>

                @if($category->slug !== 'fotografer' && $category->slug !== 'laundry')
                <x-admin.textarea name="info" label="Info Singkat" rows="3" :value="old('info')"
                    help="Teks singkat yang tampil di kartu pemilih di halaman publik." />
                @endif

                @if($category->slug !== 'fotografer')
                <x-admin.image-upload name="image" label="Gambar Utama" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                @endif

                @if(!in_array($category->slug, ['muthawif', 'laundry', 'buggy-car', 'kursi-roda-umroh']))
                <x-admin.gallery-upload name="gallery" label="Galeri Kegiatan" :existing="[]" hint="Format: JPG, PNG, WEBP. Maks 2MB per file." />
                @endif

                <div class="max-w-lg space-y-5">
                    <x-admin.input name="whatsapp" label="No WhatsApp" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari layanan / pengaturan." :value="old('whatsapp')" />
                    <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message')"
                        help="Kosongkan untuk memakai pesan dari layanan / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}." />
                    <x-admin.wa-preview name="wa_message"
                        :title-source="in_array($category->slug, ['muthawif', 'buggy-car', 'kursi-roda-umroh']) ? 'title' : null"
                        :title-prefix="match ($category->slug) {
                            'muthawif' => 'Muthawif',
                            'buggy-car', 'kursi-roda-umroh' => $service->title,
                            default => null,
                        }"
                        :number="$service->whatsapp"
                        :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => $category->itemLabel()]" />
                </div>
            </div>
        </x-admin.form-card>

        <div class="mt-6">
            <x-admin.form-actions cancel-url="{{ route('admin.services.items', $service) }}" submit-label="Simpan Data" />
        </div>
    </form>
</div>
@endsection
