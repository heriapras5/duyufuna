@extends('layouts.admin')
@section('title', 'Profil Saya')
@section('page_title', 'Profil')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
            @if($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" class="w-24 h-24 rounded-full object-cover border border-gray-200 mx-auto ring-4 ring-gold/20" alt="{{ $user->name }}">
            @else
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-dark-green to-masjid flex items-center justify-center text-white text-3xl font-bold mx-auto shadow-lg shadow-dark-green/20 ring-4 ring-gold/20">{{ substr($user->name, 0, 1) }}</div>
            @endif
            <h2 class="text-lg font-bold text-gray-900 mt-4">{{ $user->name }}</h2>
            <p class="text-sm text-gray-400">{{ $user->email }}</p>
            <p class="mt-3">
                @if($user->isSuperAdmin())
                <x-admin.badge color="gold">Super Admin</x-admin.badge>
                @elseif($user->isAdmin())
                <x-admin.badge color="green">Admin</x-admin.badge>
                @else
                <x-admin.badge>User</x-admin.badge>
                @endif
            </p>
            <p class="text-xs text-gray-400 mt-4">
                Bergabung sejak<br>
                <span class="text-gray-600 font-medium">{{ $user->created_at->format('d F Y') }}</span>
            </p>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <x-admin.form-card title="Informasi Akun" description="Perbarui data pribadi akun Anda.">
            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <x-admin.image-upload name="avatar" label="Foto Profil" :existing="$user->avatar" round hint="Format: JPG, PNG, WEBP. Maks 2MB." />
                    <x-admin.input name="name" label="Nama Lengkap" required placeholder="Nama lengkap Anda" :value="$user->name" />
                    <x-admin.input name="email" label="Email" type="email" required placeholder="nama@contoh.com" :value="$user->email" />
                    <div class="flex items-center gap-3 text-sm text-gray-500 bg-gray-50 rounded-xl p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/><path d="M12 22v-4"/><path d="M12 16v-4"/></svg>
                        <span>Role: <strong>{{ $user->isSuperAdmin() ? 'Super Admin' : ($user->isAdmin() ? 'Admin' : 'User') }}</strong></span>
                    </div>
                </div>
                <x-admin.form-actions cancel-url="{{ route('admin.dashboard') }}" submit-label="Simpan Data" />
            </form>
        </x-admin.form-card>

        <x-admin.form-card title="Ubah Password" description="Ganti password akun Anda secara berkala untuk keamanan." tone="amber">
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <x-admin.input name="current_password" label="Password Saat Ini" type="password" required placeholder="••••••••" />
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.input name="new_password" label="Password Baru" type="password" required placeholder="Password baru" />
                        <x-admin.input name="new_password_confirmation" label="Konfirmasi Password Baru" type="password" required placeholder="Ulangi password baru" />
                    </div>
                    <div class="text-xs text-gray-400 bg-amber-50 border border-amber-100 rounded-xl p-3 flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500 mt-0.5 shrink-0"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>Password minimal 8 karakter dan gunakan kombinasi huruf, angka, dan simbol untuk keamanan maksimal.</span>
                    </div>
                </div>
                <x-admin.form-actions cancel-url="{{ route('admin.dashboard') }}" submit-label="Perbarui Password" />
            </form>
        </x-admin.form-card>
    </div>
</div>
@endsection
