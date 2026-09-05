@extends('layouts.admin')
@section('title', 'Tambah Rute Transportasi')
@section('page_title', 'Tambah Rute Transportasi')
@section('page_subtitle', 'Buat rute baru beserta tarif armada')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.transport-routes.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.transport-routes.store') }}">
        @csrf
        <div class="space-y-6">
            <x-admin.form-card title="Informasi Rute" description="Rute perjalanan penjemputan & pengantaran.">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 22h14"/><path d="M5 2h14"/><path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/><path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <x-admin.input name="code" label="Kode Rute" required placeholder="Contoh: 01" :value="old('code')" help="Urutan tampil rute." />
                        <x-admin.input name="pickup_label" label="Pick Up" required placeholder="Contoh: Bandara Jeddah" :value="old('pickup_label')" help="Titik jemput yang tampil di filter." />
                        <x-admin.input name="dropoff_label" label="Drop Off" required placeholder="Contoh: Jeddah" :value="old('dropoff_label')" help="Titik antar yang tampil di filter." />
                    </div>
                </div>
            </x-admin.form-card>

            <x-admin.form-card title="Tarif Armada" description="Harga dalam SAR per kendaraan untuk rute ini." tone="green">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </x-slot:icon>
                @include('admin.transport_routes.partials.price-grid', [
                    'vehicles' => $vehicles,
                    'priceMap' => [],
                ])
            </x-admin.form-card>

            <x-admin.form-actions cancel-url="{{ route('admin.transport-routes.index') }}" submit-label="Simpan Rute" />
        </div>
    </form>
</div>
@endsection