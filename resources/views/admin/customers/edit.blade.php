@extends('layouts.admin')
@section('title', 'Edit Lead - ' . $customer->nama)
@section('page_title', 'Edit Lead')
@section('content')
@php
    $statusList = \App\Models\Customer::STATUSES;
    $statusColor = \App\Models\Customer::STATUS_COLORS;
@endphp
<div class="flex items-center justify-between gap-4 mb-6 flex-wrap">
    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
    <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
        Detail Lead
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <x-admin.form-card title="Edit Lead" description="Perbarui data pengunjung / lead.">
        <x-slot:icon>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
        </x-slot:icon>
        <form method="POST" action="{{ route('admin.customers.update', $customer) }}">
            @csrf @method('PUT')

            <p class="admin-section-title mb-4">Data Kontak</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <x-admin.input name="nama" label="Nama" required :value="$customer->nama" />
                <x-admin.input name="no_hp" label="No WhatsApp" required :value="$customer->no_hp" />
                <div class="sm:col-span-2">
                    <x-admin.textarea name="alamat" label="Alamat" rows="2" :value="$customer->alamat" />
                </div>
            </div>

            <p class="admin-section-title mb-4">Status</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <x-admin.select name="status" label="Status" :options="$statusList" :selected="$customer->status" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sumber</label>
                    <div class="mt-1.5 flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500">
                        {{ $customer->sumber ?? '-' }}
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Kategori layanan (baca saja).</p>
                </div>
            </div>

            <div class="mb-6">
                <x-admin.textarea name="catatan" label="Catatan Perubahan Status (opsional)" rows="3" :value="old('catatan')" />
            </div>

            <x-admin.form-actions cancel-url="{{ route('admin.customers.index') }}" submit-label="Simpan Data" />
        </form>
    </x-admin.form-card>
</div>
@endsection