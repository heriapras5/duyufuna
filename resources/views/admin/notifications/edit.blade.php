@extends('layouts.admin')
@section('title', 'Edit Notifikasi')
@section('page_title', 'Edit Notifikasi')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Edit Notifikasi" description="Perbarui pesan / notifikasi.">
        <form method="POST" action="{{ route('admin.notifications.update', $notification) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-5">
                <x-admin.input name="title" label="Judul" required placeholder="Contoh: Pengumuman Libur" :value="$notification->title" />
                <x-admin.textarea name="body" label="Konten" rows="4" placeholder="Isi pesan notifikasi" :value="$notification->body" />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.image-upload name="image" label="Gambar" :existing="$notification->image" hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                </div>
                <x-admin.input name="url" label="URL (opsional)" placeholder="https://…" :value="$notification->url" help="Tautan tujuan saat notifikasi diklik." />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.switch name="is_active" label="Aktif" :checked="$notification->is_active" help="Tampilkan notifikasi ini di halaman publik." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.notifications.index') }}" submit-label="Simpan Data" />
        </form>
    </x-admin.form-card>
</div>
@endsection
