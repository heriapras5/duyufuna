@extends('layouts.admin')
@section('title', 'Edit Banner')
@section('page_title', 'Edit Banner')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Edit Banner" description="Perbarui gambar slider halaman beranda.">
        <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-5">
                <x-admin.input name="title" label="Judul" placeholder="Contoh: Pembukaan Cabang Baru" :value="$banner->title" />
                <x-admin.textarea name="subtitle" label="Sub Judul" rows="2" placeholder="Satu kalimat penguat" :value="$banner->subtitle" />
                <x-admin.input name="sort" label="Urutan" type="number" min="0" placeholder="0" :value="old('sort', $banner->sort)"
                    help="Semakin kecil angkanya, semakin awal banner tampil di slider." />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.switch name="status" label="Tampilkan" :checked="$banner->status" help="Nonaktifkan untuk menyembunyikan banner sementara." />
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.image-upload name="image" label="Gambar" :existing="$banner->image" hint="Gambar tampil penuh tanpa crop — bebas rasio, disarankan landscape. Format: JPG, PNG, WEBP. Maks 10MB." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.banners.index') }}" submit-label="Simpan Data" />
        </form>
    </x-admin.form-card>
</div>
@endsection
