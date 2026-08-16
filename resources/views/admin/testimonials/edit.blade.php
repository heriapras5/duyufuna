@extends('layouts.admin')
@section('title', 'Edit Testimoni')
@section('page_title', 'Edit Testimoni')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Edit Testimoni" description="Perbarui ulasan pelanggan.">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-5">
                <x-admin.input name="name" label="Nama" required placeholder="Contoh: Bapak Ahmad" :value="$testimonial->name" />
                <x-admin.select name="rating" label="Rating (1-5)" :options="[5 => '5 Bintang', 4 => '4 Bintang', 3 => '3 Bintang', 2 => '2 Bintang', 1 => '1 Bintang']" :selected="$testimonial->rating" />
                <x-admin.summernote name="review" label="Isi Testimoni" :value="$testimonial->review" required />
                <div class="border-t border-gray-100 pt-4">
                    <x-admin.switch name="status" label="Tampilkan" :checked="$testimonial->status" help="Tampilkan testimoni ini di halaman publik." />
                </div>
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.testimonials.index') }}" submit-label="Simpan Data" />
        </form>
    </x-admin.form-card>
</div>
@endsection
