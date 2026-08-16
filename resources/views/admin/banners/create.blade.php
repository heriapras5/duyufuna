@extends('layouts.admin')
@section('title', 'Tambah Banner')
@section('page_title', 'Tambah Banner')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Tambah Banner" description="Tambahkan gambar untuk slider di halaman beranda.">
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-5">
                <x-admin.input name="title" label="Judul" placeholder="Contoh: Pembukaan Cabang Baru" :value="old('title')" />
                <x-admin.textarea name="subtitle" label="Sub Judul" rows="2" placeholder="Satu kalimat penguat" :value="old('subtitle')" />
                <x-admin.input name="sort" label="Urutan" type="number" min="0" placeholder="0" :value="old('sort')"
                    help="Semakin kecil angkanya, semakin awal banner tampil di slider." />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.image-upload name="image" label="Gambar" required hint="Format: JPG, PNG, WEBP. Maks 10MB." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.banners.index') }}" submit-label="Simpan" />
        </form>
    </x-admin.form-card>
</div>
@endsection
