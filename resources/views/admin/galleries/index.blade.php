@extends('layouts.admin')
@section('title', 'Galeri')
@section('page_title', 'Galeri')
@section('content')
<x-admin.search route="admin.galleries.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.galleries.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Gambar</x-admin.th>
            <x-admin.th>Judul</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($galleries as $g)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $galleries->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td><img src="{{ Storage::url($g->image) }}" data-popup-image="{{ Storage::url($g->image) }}" alt="{{ $g->title }}" class="w-24 h-14 object-cover rounded-lg border border-gray-100 cursor-zoom-in" title="Klik untuk perbesar"></x-admin.td>
        <x-admin.td class="font-medium text-gray-900">{{ $g->title }}</x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.galleries.edit" destroy="admin.galleries.destroy" :params="[$g]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="4" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada foto.'" />
    @endforelse
    <x-slot:footer>
        @if($galleries->hasPages())
        <div>{{ $galleries->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@include('admin.partials.image-popup')
@endsection
