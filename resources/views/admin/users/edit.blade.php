@extends('layouts.admin')
@section('title', 'Edit Pengguna')
@section('page_title', 'Edit Pengguna')
@section('content')
@php
    $superAdminExists = \App\Models\User::superAdminExists();
    $roleLocked = $user->isSuperAdmin();
    $roleOptions = ['admin' => 'Admin', 'super_admin' => 'Super Admin'];
    $disabledRoleOptions = $roleLocked ? [] : ($superAdminExists ? ['super_admin'] : []);
@endphp
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-2xl mx-auto">
    <x-admin.form-card title="Edit Pengguna" description="Perbarui data akun pengguna.">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="space-y-5">
                <div class="pb-4 border-b border-gray-50">
                    <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin' }}</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-admin.input name="name" label="Nama" required placeholder="Contoh: Admin Website" :value="$user->name" />
                    <x-admin.input name="username" label="Username" required placeholder="contoh: admin01" :value="$user->username" />
                </div>
                <x-admin.input name="email" label="Email" type="email" required placeholder="nama@contoh.com" :value="$user->email" />
                <x-admin.select name="role" label="Role" :options="$roleOptions" :disabled-options="$disabledRoleOptions" :selected="$user->role" :disabled="$roleLocked"
                    help="{{ $roleLocked ? 'Role Super Admin tidak dapat diubah / dihapus.' : ($superAdminExists ? 'Opsi Super Admin dinonaktifkan karena Super Admin sudah ada.' : 'Opsi Super Admin hanya untuk 1 akun.') }}" />
                <x-admin.input name="password" label="Password" type="password" help="Biarkan kosong jika tidak ingin mengubah password." />
            </div>
            <x-admin.form-actions cancel-url="{{ route('admin.users.index') }}" submit-label="Simpan Data" />
        </form>
    </x-admin.form-card>
</div>
@endsection
