@extends('layouts.admin')
@section('title', 'Notifikasi')
@section('page_title', 'Notifikasi')
@section('content')
<x-admin.search route="admin.notifications.index" placeholder="Cari judul atau isi..." />

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-14 text-center">No</x-admin.th>
            <x-admin.th>Judul</x-admin.th>
            <x-admin.th>Status</x-admin.th>
            <x-admin.th>Tanggal</x-admin.th>
            <x-admin.th class="text-right">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($notifications as $n)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $notifications->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td>
            <div class="flex items-center gap-3">
                @if($n->image)
                <img src="{{ Storage::url($n->image) }}" data-popup-image="{{ Storage::url($n->image) }}" alt="{{ $n->title }}" class="w-10 h-10 rounded-lg object-cover border border-gray-100 shrink-0 cursor-zoom-in" title="Klik untuk perbesar">
                @endif
                <div>
                    <p class="font-medium text-gray-900 text-sm">{{ $n->title }}</p>
                    @if($n->body)<p class="text-xs text-gray-400 line-clamp-1 mt-0.5">{{ $n->body }}</p>@endif
                </div>
            </div>
        </x-admin.td>
        <x-admin.td>
            <x-admin.badge :color="$n->is_active ? 'green' : 'red'">{{ $n->is_active ? 'Aktif' : 'Nonaktif' }}</x-admin.badge>
        </x-admin.td>
        <x-admin.td class="text-[13px] text-gray-600 whitespace-nowrap tabular-nums">{{ $n->created_at->format('d M Y H:i') }}</x-admin.td>
        <x-admin.td class="text-right">
            <x-admin.actions edit="admin.notifications.edit" destroy="admin.notifications.destroy" :params="[$n]" />
        </x-admin.td>
    </tr>
    @empty
    <x-admin.empty-state :colspan="5" :message="request()->filled('search') ? 'Tidak ditemukan hasil untuk pencarian ini.' : 'Belum ada notifikasi.'" />
    @endforelse
    <x-slot:footer>
        @if($notifications->hasPages())
        <div>{{ $notifications->links('vendor.pagination.admin') }}</div>
        @endif
    </x-slot:footer>
</x-admin.table>
@include('admin.partials.image-popup')
@endsection
