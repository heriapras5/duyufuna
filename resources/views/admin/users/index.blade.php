@extends('layouts.admin')
@section('title', 'Pengguna')
@section('page_title', 'Pengguna')
@section('content')
<x-admin.search route="admin.users.index">
    <x-slot:actions>
        @if(auth()->user()->isSuperAdmin())
        <x-admin.add-button route="admin.users.create" label="Tambah Data" />
        @endif
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Nama</x-admin.th>
            <x-admin.th>Email</x-admin.th>
            <x-admin.th>Role</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($users as $u)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $users->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td>
            <p class="font-medium text-gray-900 text-sm">{{ $u->name }}</p>
        </x-admin.td>
        <x-admin.td class="text-gray-500 text-sm">{{ $u->email }}</x-admin.td>
        <x-admin.td>
            @if($u->isSuperAdmin())
            <x-admin.badge color="gold">Super Admin</x-admin.badge>
            @else
            <x-admin.badge color="green">Admin</x-admin.badge>
            @endif
        </x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.users.edit"
                             :destroy="$u->isSuperAdmin() ? null : 'admin.users.destroy'"
                             :params="[$u]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="5" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada pengguna.'" />
    @endforelse
    <x-slot:footer>
        @if($users->hasPages())
        <div>{{ $users->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@endsection
