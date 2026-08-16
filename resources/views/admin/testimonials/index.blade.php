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
            <x-admin.th>Nama</x-admin.th>
            <x-admin.th>Pesan</x-admin.th>
            <x-admin.th>Rating</x-admin.th>
            <x-admin.th>Status</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($testimonials as $t)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $testimonials->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td class="font-medium text-gray-900">{{ $t->name }}</x-admin.td>
        <x-admin.td class="text-gray-500 max-w-xs truncate" title="{{ $t->review }}">{{ $t->review }}</x-admin.td>
        <x-admin.td>
            <span class="inline-flex items-center gap-0.5 text-amber-500" title="{{ $t->rating }} dari 5 bintang">
                @for($i = 1; $i <= 5; $i++)
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="{{ $i <= $t->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $i <= $t->rating ? '' : 'text-gray-300' }}"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                @endfor
            </span>
        </x-admin.td>
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
