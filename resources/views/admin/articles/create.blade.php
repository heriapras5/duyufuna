@extends('layouts.admin')
@section('title', 'Tambah Artikel')
@section('page_title', 'Tambah Artikel')
@section('content')
<style>
.note-editor { border-radius: 0.75rem !important; overflow: hidden; }
</style>
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <x-admin.form-card title="Informasi Artikel" description="Kategori, judul, dan konten artikel.">
                <div class="space-y-5">
                    <x-admin.select name="article_category_id" label="Kategori Artikel" placeholder="— Pilih Kategori —"
                        :options="$categories->pluck('name', 'id')->toArray()"
                        :selected="old('article_category_id')" />
                    <x-admin.input name="title" label="Judul" required placeholder="Contoh: Tips Persiapan Umroh" :value="old('title')" />
                    <x-admin.textarea name="excerpt" label="Sub Judul" rows="2" placeholder="Sub Judul artikel" :value="old('excerpt')" />
                    <x-admin.summernote name="content" label="Konten" :value="old('content')" required />
                </div>
            </x-admin.form-card>

            <x-admin.form-card title="Gambar Sampul" description="Gambar yang tampil sebagai thumbnail artikel." tone="amber">
                <div class="max-w-lg">
                    <x-admin.image-upload name="image" label="Gambar Sampul" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                </div>
            </x-admin.form-card>

            <x-admin.form-card title="Status Publikasi" description="Kontrol tampilnya artikel di website." tone="blue">
                <x-admin.switch name="status" label="Publikasikan" :checked="true" help="Artikel langsung tampil di halaman publik." />
            </x-admin.form-card>

            <x-admin.form-card title="SEO Artikel" description="Optimasi mesin pencari untuk artikel." tone="purple">
                <div class="space-y-5">
                    <x-admin.input name="seo_title" label="SEO Title" placeholder="Judul di Google (50–60 karakter)" :value="old('seo_title')" />
                    <x-admin.textarea name="seo_description" label="Meta Description" rows="2" placeholder="Deskripsi di Google (150–160 karakter)" :value="old('seo_description')" />
                    <x-admin.input name="seo_keywords" label="Meta Keywords" placeholder="kata kunci, dipisah, dengan, koma" :value="old('seo_keywords')" />
                </div>
            </x-admin.form-card>

            <x-admin.form-actions cancel-url="{{ route('admin.articles.index') }}" submit-label="Simpan" />
        </div>
    </form>
</div>
@endsection
