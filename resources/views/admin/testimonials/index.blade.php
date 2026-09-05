@extends('layouts.admin')
@section('title', 'Testimoni')
@section('page_title', 'Testimoni')
@section('content')
<x-admin.search route="admin.testimonials.index">
    <x-slot:actions>
        <x-admin.add-button route="admin.testimonials.create" label="Tambah Data" />
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Gambar</x-admin.th>
            <x-admin.th>Nama</x-admin.th>
            <x-admin.th>Pesan</x-admin.th>
            <x-admin.th>Status</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($testimonials as $t)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $testimonials->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td>
            @if($t->image)
            <a href="{{ Storage::url($t->image) }}" data-fancybox="testimoni-admin" data-caption="Testimoni {{ $t->name ?: '#' . $t->id }}" title="Lihat gambar">
                <img src="{{ Storage::url($t->image) }}" alt="Testimoni {{ $t->name ?: '#' . $t->id }}" loading="lazy" class="w-12 h-12 rounded-lg object-cover border border-gray-200 hover:opacity-90 transition">
            </a>
            @else
            <span class="text-gray-300 text-sm">-</span>
            @endif
        </x-admin.td>
        <x-admin.td class="font-medium text-gray-900">{{ $t->name ?: '-' }}</x-admin.td>
        <x-admin.td class="text-gray-500 max-w-xs truncate" title="{{ $t->review }}">{{ strip_tags($t->review) }}</x-admin.td>
        <x-admin.td>
            <x-admin.status-toggle resource="testimonials" :id="$t->id" :checked="$t->status" />
        </x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.testimonials.edit" destroy="admin.testimonials.destroy" :params="[$t]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="6" :message="request()->filled('search') ? 'Data tidak ditemukan.' : 'Belum ada testimonial.'" />
    @endforelse
    <x-slot:footer>
        @if($testimonials->hasPages())
        <div>{{ $testimonials->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@endsection
