@extends('layouts.admin')
@section('title', 'Edit ' . $category->itemLabel())
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Edit ' . Str::lower($category->itemLabel()) . ' "' . $item->title . '" pada "' . $service->title . '"')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.services.items', $service) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>

<div class="max-w-5xl mx-auto">
    <form method="POST" action="{{ route('admin.services.items.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-admin.form-card title="Edit {{ $category->itemLabel() }}"
                           description="Perbarui data {{ Str::lower($category->itemLabel()) }} di bawah ini lalu simpan.">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
            </x-slot:icon>
            <div class="space-y-5">
                <x-admin.input name="title" label="{{ $category->slug === 'laundry' ? 'Nama Paket' : 'Nama ' . $category->itemLabel() }}" required placeholder="{{ $category->itemPlaceholder() }}" :value="old('title', $item->title)" />

                @if($category->slug === 'laundry')
                <x-admin.input name="tagline" label="Keterangan" placeholder="cth: 1-5 Kg" :value="old('tagline', $item->tagline)"
                    help="Keterangan berat paket, tampil di bawah nama paket pada kartu publik." />
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-admin.input name="price" type="number" step="1" min="0" label="{{ $category->slug === 'muthawif' ? 'SAR' : 'Harga (SAR)' }}" placeholder="cth: 110" :value="old('price', $item->price_per_night)" help="Harga dalam Riyal Saudi. Kosongkan jika belum ada." />
                    <x-admin.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Nonaktif']" :selected="old('status', $item->status)" />
                </div>

                @if($category->slug !== 'fotografer' && $category->slug !== 'laundry')
                <x-admin.textarea name="info" label="Info Singkat" rows="3" :value="old('info', $item->info)"
                    placeholder="Contoh: Waktu pengerjaan ± 24 jam · Antar-jemput ke kamar hotel"
                    help="Teks singkat yang tampil di kartu pemilih di halaman publik." />
                @endif

                @if($category->slug !== 'fotografer')
                <x-admin.image-upload name="image" label="Gambar Utama" :existing="$item->image" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                @endif

                @if(!in_array($category->slug, ['muthawif', 'laundry', 'buggy-car', 'kursi-roda-umroh']))
                <x-admin.gallery-upload name="gallery" label="Galeri Kegiatan" :existing="$item->gallery ?? []" hint="Unggah 4 foto per kegiatan (maks 8). Format: JPG, PNG, WEBP. Maks 2MB per file." />
                @endif
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <x-admin.form-card title="Pengaturan Pesan" description="Nomor HP dan teks pesan untuk tombol konsultasi {{ Str::lower($category->itemLabel()) }} ini." tone="green">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
                    </x-slot:icon>
                    <div class="max-w-lg space-y-5">
                        <x-admin.input name="whatsapp" label="No WhatsApp" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari layanan / pengaturan." :value="old('whatsapp', $item->whatsapp)" />
                        <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message', $item->wa_message)"
                            help="Kosongkan untuk memakai pesan dari layanan / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}. {item} otomatis terisi nama {{ Str::lower($category->itemLabel()) }} yang dipilih pengunjung." />
                        <x-admin.wa-preview name="wa_message"
                            :title-source="in_array($category->slug, ['muthawif', 'buggy-car', 'kursi-roda-umroh']) ? 'title' : null"
                            :title-prefix="match ($category->slug) {
                                'muthawif' => 'Muthawif',
                                'buggy-car', 'kursi-roda-umroh' => $service->title,
                                default => null,
                            }"
                            :number="$item->whatsapp ?: $service->whatsapp"
                            :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => $item->title]" />
                    </div>
                </x-admin.form-card>
            </div>

            <div class="mt-6">
                <x-admin.form-actions cancel-url="{{ route('admin.services.items', $service) }}" submit-label="Simpan Data" />
            </div>
        </x-admin.form-card>
    </form>
</div>
@endsection