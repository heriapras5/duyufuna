@extends('layouts.admin')
@section('title', 'Tambah FAQ')
@section('page_title', 'Tambah FAQ')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Tambah FAQ" description="Buat pertanyaan yang sering ditanyakan pelanggan.">
        <form method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf
            <div class="space-y-5">
                <x-admin.input name="question" label="Pertanyaan" required placeholder="Contoh: Bagaimana cara mendaftar?" :value="old('question')" />
                <x-admin.summernote name="answer" label="Jawaban" :value="old('answer')" required />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.switch name="status" label="Aktif" :checked="true" help="Tampilkan FAQ ini di halaman publik." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.faqs.index') }}" submit-label="Simpan" />
        </form>
    </x-admin.form-card>
</div>
@endsection
