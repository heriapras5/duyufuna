@extends('layouts.admin')
@section('title', 'Banner')
@section('page_title', 'Banner')
@section('content')
<x-admin.search route="admin.banners.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.banners.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Gambar</x-admin.th>
            <x-admin.th>Judul</x-admin.th>
            <x-admin.th>Sub Judul</x-admin.th>
            <x-admin.th class="w-20 text-center">Urutan</x-admin.th>
            <x-admin.th class="w-24 text-center">Status</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($banners as $banner)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $banners->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td><img src="{{ Storage::url($banner->image) }}" data-popup-image="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" class="w-24 h-14 object-cover rounded-lg border border-gray-100 cursor-zoom-in" title="Klik untuk perbesar"></x-admin.td>
        <x-admin.td>
            <div class="font-medium text-gray-900">{{ $banner->title ?: '-' }}</div>
        </x-admin.td>
        <x-admin.td>
            <div class="text-sm text-gray-500 truncate max-w-[280px]">{{ $banner->subtitle ?: '-' }}</div>
        </x-admin.td>
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $banner->sort }}</x-admin.td>
        <x-admin.td class="text-center">
            <x-admin.status-toggle resource="banners" :id="$banner->id" :checked="$banner->status" />
        </x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.banners.edit" destroy="admin.banners.destroy" :params="[$banner]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="7" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada banner.'" />
    @endforelse
    <x-slot:footer>
        @if($banners->hasPages())
        <div>{{ $banners->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@include('admin.partials.image-popup')
@endsection
