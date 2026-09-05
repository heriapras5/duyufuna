@extends('layouts.admin')
@section('title', 'Tambah Testimoni')
@section('page_title', 'Tambah Testimoni')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Tambah Testimoni" description="Tambahkan ulasan pelanggan untuk ditampilkan di website.">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-5">
                <x-admin.input name="name" label="Nama" :value="old('name')" help="Opsional — boleh dikosongkan bila hanya menampilkan gambar." />
                <x-admin.image-upload name="image" label="Gambar Screenshot Chat WhatsApp" hint="Upload screenshot percakapan WhatsApp sebagai bukti. Format: JPG, PNG, WEBP. Maks 2MB. Gambar otomatis diperkecil menjadi maks. 640px." />
                <x-admin.summernote name="review" label="Isi Testimoni" :value="old('review')" help="Opsional — boleh dikosongkan bila hanya menampilkan gambar." />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.switch name="status" label="Tampilkan" :checked="true" help="Tampilkan testimoni ini di halaman publik." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.testimonials.index') }}" submit-label="Simpan" />
        </form>
    </x-admin.form-card>
</div>
@endsection
