@extends('layouts.admin')
@section('title', 'Tambah Kategori Artikel')
@section('page_title', 'Tambah Kategori Artikel')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.article_categories.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl">
    <x-admin.form-card title="Tambah Kategori Artikel" description="Buat kategori untuk mengelompokkan artikel.">
        <form method="POST" action="{{ route('admin.article_categories.store') }}">
            @csrf
            <div class="space-y-5">
                <x-admin.input name="name" label="Nama" required placeholder="Contoh: Berita" :value="old('name')" />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.switch name="status" label="Aktifkan kategori" :checked="true" />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.article_categories.index') }}" submit-label="Simpan" />
        </form>
    </x-admin.form-card>
</div>
@endsection
