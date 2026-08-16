@extends('layouts.admin')
@section('title', 'Tambah Pengguna')
@section('page_title', 'Tambah Pengguna')
@section('content')
@php
    $superAdminExists = \App\Models\User::superAdminExists();
    $roleOptions = ['admin' => 'Admin', 'super_admin' => 'Super Admin'];
    $disabledRoleOptions = $superAdminExists ? ['super_admin'] : [];
@endphp
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Tambah Pengguna" description="Daftarkan akun Admin/Super Admin baru untuk mengelola website.">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-admin.input name="name" label="Nama" required placeholder="Contoh: Admin Website" :value="old('name')" />
                    <x-admin.input name="username" label="Username" required placeholder="contoh: admin01" :value="old('username')" />
                </div>
                <x-admin.input name="email" label="Email" type="email" required placeholder="nama@contoh.com" :value="old('email')" />
                <x-admin.select name="role" label="Role" :options="$roleOptions" :disabled-options="$disabledRoleOptions" :selected="old('role', 'admin')" required
                    help="{{ $superAdminExists ? 'Super Admin sudah ada dan hanya 1 akun, sehingga opsi Super Admin dinonaktifkan.' : 'Super Admin hanya dapat dibuat 1 akun.' }}" />
                <x-admin.input name="password" label="Password" type="password" required help="Gunakan kombinasi huruf dan angka. Minimal 8 karakter." />
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.users.index') }}" submit-label="Simpan" />
        </form>
    </x-admin.form-card>
</div>
@endsection
