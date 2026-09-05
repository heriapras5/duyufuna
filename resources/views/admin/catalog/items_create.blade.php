@extends('layouts.admin')
@section('title', 'Tambah ' . $category->itemLabel())
@section('page_title', $category->icon . ' ' . $category->name)
@section('page_subtitle', 'Tambah ' . Str::lower($category->itemLabel()) . ' baru untuk "' . $service->title . '"')
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.catalog.items', [$category, $service]) }}" class="btn btn-secondary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.catalog.items.store', [$category, $service]) }}" enctype="multipart/form-data">
        @csrf
        <x-admin.form-card title="Tambah {{ $category->itemLabel() }} Baru"
                           description="Lengkapi data di bawah ini lalu simpan." tone="green">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </x-slot:icon>
            <div class="space-y-5">
                <x-admin.input name="title" label="Nama {{ $category->itemLabel() }}" required :value="old('title')" />
                @if($category->isHotel() || $category->slug === 'visa' || $category->isHandling())
                <x-admin.slug-preview source="title" base="detail" />
                @endif
                @if($category->isHotel())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-admin.select name="star" label="Bintang Hotel" :options="[1 => '1 Bintang', 2 => '2 Bintang', 3 => '3 Bintang', 4 => '4 Bintang', 5 => '5 Bintang']" :selected="old('star')" />
                    <x-admin.input name="area" label="Area / Kawasan" :value="old('area')" />
                    <x-admin.input name="distance" type="text" label="{{ $service->distanceLabel() }}" :value="old('distance')" />
                    <x-admin.input name="walk_time" label="Estimasi Jalan Kaki" :value="old('walk_time')" />
                    <div class="md:col-span-2">
                        <x-admin.input name="room_types" label="Tipe Kamar" :value="old('room_types')" />
                    </div>
                </div>
                <div class="pt-2">
                    <x-admin.summernote name="description" label="Deskripsi" :value="old('description')" :height="260" />
                </div>
                <div class="pt-2">
                    <x-admin.textarea name="benefit" label="Daftar Kelebihan (Checklist)" rows="14" :value="old('benefit')"
                        help="Tampil sebagai daftar centang pada halaman detail hotel. Satu baris = satu poin kelebihan." />
                </div>
                <div class="pt-2">
                    <x-admin.summernote name="recommendation" label="Keterangan" :value="old('recommendation')" :height="90"
                        help="Catatan singkat yang tampil pada halaman detail hotel." />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-admin.input name="price_text" label="Harga (SAR)" :value="old('price_text')" />
                    <x-admin.input name="map_link" label="Link Peta (opsional)" :value="old('map_link')" />
                </div>
                @endif
                @if($category->slug === 'visa')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <x-admin.input name="price_text" label="Harga (US$)" placeholder="cth: 300 atau 300 - 500" :value="old('price_text')" help="Tulis satu harga (300) atau rentang (300 - 500)." />
                    </div>
                </div>
                @endif
                @if($category->slug === 'jastip-viral')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-admin.input name="price" type="number" step="1" min="0" label="Harga (SAR)" :value="old('price')" help="Harga dalam Riyal Saudi. Kosongkan jika belum ada." />
                </div>
                @endif
                @if($category->isHandling())
                {{-- Paket & Tarif — mengikuti urutan kartu publik: Tagline → Include → Tier PAX --}}
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <x-admin.section-title title="Paket & Tarif" subtitle="Isi yang tampil pada kartu paket dan kalkulator PAX di halaman publik." />
                    <div class="mt-5 space-y-5">
                        <x-admin.input name="tagline" label="Tagline" placeholder="cth: Paket ekonomis untuk rombongan besar" :value="old('tagline')" help="Teks singkat di bawah nama paket pada kartu." />
                        <x-admin.textarea name="benefit" label="Daftar Include (satu per baris)" rows="8" :value="old('benefit')"
                            help="Tampil sebagai daftar centang &quot;Include&quot; pada kartu. Satu baris = satu poin." />
                        <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-4" x-data="{
                            tiers: @js(old('pax_prices', [['min' => 35, 'max' => 47, 'price' => ''], ['min' => 25, 'max' => 34, 'price' => ''], ['min' => 16, 'max' => 24, 'price' => ''], ['min' => 11, 'max' => 15, 'price' => '']])),
                            add() { this.tiers.push({min: '', max: '', price: ''}); },
                            remove(i) { this.tiers.splice(i, 1); },
                        }">
                            <div class="flex items-center justify-between gap-3 mb-1.5">
                                <label class="block text-sm font-medium text-gray-700">Harga per Tier PAX (US$)</label>
                                <button type="button" @click="add()" class="btn btn-secondary btn-sm">+ Tambah Tier</button>
                            </div>
                            <p class="text-xs text-gray-400 mb-3">Satu baris = satu rentang jumlah jamaah. Baris yang dikosongkan diabaikan saat disimpan. Deskripsi &amp; tabel harga kartu dibuat otomatis dari data ini.</p>
                        <div class="space-y-2">
                            <div class="grid grid-cols-[1fr_1fr_1fr_auto] gap-2 pb-1.5 border-b border-gray-200">
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">Min PAX</p>
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">Max PAX</p>
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">Harga (US$)</p>
                                <span></span>
                            </div>
                            <template x-for="(t, i) in tiers" :key="i">
                                <div class="grid grid-cols-[1fr_1fr_1fr_auto] gap-2 items-center">
                                    <input type="number" :name="'pax_prices[' + i + '][min]'" x-model="t.min" min="1" class="admin-input">
                                    <input type="number" :name="'pax_prices[' + i + '][max]'" x-model="t.max" min="1" class="admin-input">
                                    <input type="number" :name="'pax_prices[' + i + '][price]'" x-model="t.price" min="0" step="0.01" class="admin-input">
                                    <button type="button" @click="remove(i)" title="Hapus tier" class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                            <p x-show="tiers.length === 0" class="text-xs text-gray-400">Belum ada tier — halaman publik menampilkan &quot;Di luar rentang&quot; untuk semua jumlah PAX.</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="pt-2">
                    @if($category->isHandling())
                    <p class="text-xs text-slate-400">Deskripsi dan tabel harga dihasilkan otomatis dari data paket.</p>
                    @elseif(!$category->isHotel())
                    <x-admin.summernote name="description" label="Deskripsi" :value="old('description')" :height="260" />
                    @endif
                </div>
                @if(!$category->isHandling())
                <x-admin.image-upload name="image" label="Gambar Utama" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                @endif
                @if($category->isHotel())
                <x-admin.gallery-upload name="gallery" label="Thumbnail" />
                @endif
                <x-admin.input name="whatsapp" label="No WhatsApp (opsional)" help="Format: kode negara tanpa +. Kosongkan untuk memakai nomor dari grup / pengaturan." :value="old('whatsapp')" />
                <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp (opsional)" rows="3" :value="old('wa_message')"
                    help="Kosongkan untuk memakai pesan dari grup / pengaturan. Variabel: {nama}, {no_hp}, {kategori}, {layanan}, {website}, {item}, {tanggal}." />
                <x-admin.wa-preview name="wa_message" title-source="title"
                    :number="$service->whatsapp"
                    :sample="['kategori' => $category->name, 'layanan' => $service->title, 'item' => $category->itemLabel() . ' A']" />
            </div>
        </x-admin.form-card>

        <div class="mt-6">
            <x-admin.form-actions cancel-url="{{ route('admin.catalog.items', [$category, $service]) }}" submit-label="Simpan" />
        </div>
    </form>
</div>
@endsection
