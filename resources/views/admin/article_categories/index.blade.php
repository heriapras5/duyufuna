@extends('layouts.admin')
@section('title', 'Kategori Artikel')
@section('page_title', 'Kategori Artikel')
@section('content')
<x-admin.search route="admin.article_categories.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.article_categories.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Nama</x-admin.th>
            <x-admin.th class="w-24 text-center">Jumlah Artikel</x-admin.th>
            <x-admin.th>Status</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($categories as $cat)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $categories->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td class="font-medium text-gray-900">{{ $cat->name }}</x-admin.td>
        <x-admin.td class="text-center text-gray-500 tabular-nums">{{ $cat->articles_count }}</x-admin.td>
        <x-admin.td>
            <x-admin.status-toggle resource="article_categories" :id="$cat->id" :checked="$cat->status" />
        </x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.article_categories.edit" destroy="admin.article_categories.destroy" :params="[$cat]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="5" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada kategori artikel.'" />
    @endforelse
    <x-slot:footer>
        @if($categories->hasPages())
        <div>{{ $categories->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@endsection
