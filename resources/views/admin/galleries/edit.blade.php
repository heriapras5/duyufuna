@extends('layouts.admin')
@section('title', 'Edit Galeri')
@section('page_title', 'Edit Galeri')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Edit Galeri" description="Perbarui foto dokumentasi kegiatan.">
        <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-5">
                <x-admin.input name="title" label="Judul" required placeholder="Contoh: Kegiatan Ramadhan 2026" :value="$gallery->title" />
                <x-admin.summernote name="description" label="Deskripsi" :value="$gallery->description" />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.image-upload name="image" label="Gambar" :existing="$gallery->image" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.galleries.index') }}" submit-label="Simpan Data" />
        </form>
    </x-admin.form-card>
</div>
@endsection
