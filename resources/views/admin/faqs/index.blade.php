@extends('layouts.admin')
@section('title', 'FAQ')
@section('page_title', 'FAQ')
@section('content')
<x-admin.search route="admin.faqs.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.faqs.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Pertanyaan</x-admin.th>
            <x-admin.th>Status</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($faqs as $faq)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $faqs->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td class="font-medium text-gray-900 max-w-md truncate">{{ $faq->question }}</x-admin.td>
        <x-admin.td>
            <x-admin.status-toggle resource="faqs" :id="$faq->id" :checked="$faq->status" />
        </x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.faqs.edit" destroy="admin.faqs.destroy" :params="[$faq]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="4" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada FAQ.'" />
    @endforelse
    <x-slot:footer>
        @if($faqs->hasPages())
        <div>{{ $faqs->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@endsection
