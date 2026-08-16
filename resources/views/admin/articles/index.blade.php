@extends('layouts.admin')
@section('title', 'Artikel')
@section('page_title', 'Artikel')
@section('content')
<x-admin.search route="admin.articles.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.articles.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th class="w-28">Gambar</x-admin.th>
            <x-admin.th>Judul</x-admin.th>
            <x-admin.th>Kategori</x-admin.th>
            <x-admin.th>Tanggal</x-admin.th>
            <x-admin.th>Status</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($articles as $a)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $articles->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td>
            @if($a->image)
            <img src="{{ Storage::url($a->image) }}" data-popup-image="{{ Storage::url($a->image) }}" alt="{{ $a->title }}" class="w-24 h-14 rounded-lg object-cover border border-gray-100 cursor-zoom-in" title="Klik untuk perbesar">
            @else
            <span class="text-xs text-gray-400">-</span>
            @endif
        </x-admin.td>
        <x-admin.td>
            <span class="font-medium text-gray-900">{{ $a->title }}</span>
        </x-admin.td>
        <x-admin.td class="text-gray-500">{{ $a->category->name ?? '-' }}</x-admin.td>
        <x-admin.td class="text-sm text-gray-600 whitespace-nowrap tabular-nums">{{ $a->created_at->format('d M Y') }}</x-admin.td>
        <x-admin.td>
            <x-admin.status-toggle resource="articles" :id="$a->id" :checked="$a->status" />
        </x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.articles.edit" destroy="admin.articles.destroy" :params="[$a]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="7" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada artikel.'" />
    @endforelse
    <x-slot:footer>
        @if($articles->hasPages())
        <div>{{ $articles->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@include('admin.partials.image-popup')
@endsection
