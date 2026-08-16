@extends('layouts.admin')
@section('title', 'Traffic')
@section('page_title', 'Traffic')
@section('content')
@php
    $statusList = \App\Models\Customer::STATUSES;
    $statusBadge = [
        'baru' => 'gold',
        'pelanggan' => 'green',
        'dihubungi' => 'blue',
        'konversi' => 'green',
        'batal' => 'red',
    ];
@endphp

<x-admin.search route="admin.traffics.index" placeholder="Cari nama, nomor, layanan...">
    <x-slot:filters>
        <select name="status" class="admin-input bg-white w-auto">
            <option value="">Semua Status</option>
            @foreach($statusList as $value => $text)
            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $text }}</option>
            @endforeach
        </select>
        <select name="device" class="admin-input bg-white max-w-[150px]">
            <option value="">Semua Device</option>
            @foreach($devices as $d)
            <option value="{{ $d }}" @selected(request('device') === $d)>{{ $d }}</option>
            @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="admin-input w-auto" title="Dari tanggal">
        <span class="text-xs text-gray-400 -mx-1">–</span>
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="admin-input w-auto" title="Sampai tanggal">
    </x-slot:filters>
    <x-slot:actions>
        @include('admin.partials.export-dropdown', [
            'excelRoute' => route('admin.traffics.export-excel', request()->query()),
            'pdfRoute' => route('admin.traffics.pdf-preview', request()->query()),
        ])
    </x-slot:actions>
</x-admin.search>

<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-10 text-center">No</x-admin.th>
            <x-admin.th class="min-w-[130px]">Tanggal</x-admin.th>
            <x-admin.th class="min-w-[200px]">Nama</x-admin.th>
            <x-admin.th class="min-w-[150px]">No WhatsApp</x-admin.th>
            <x-admin.th class="min-w-[130px]">Sumber</x-admin.th>
            <x-admin.th class="min-w-[100px]">Device</x-admin.th>
            <x-admin.th class="min-w-[100px]">Status</x-admin.th>
            <x-admin.th class="text-right sticky-col min-w-[52px]">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($traffics as $t)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $traffics->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td class="text-[13px] text-gray-600 whitespace-nowrap tabular-nums">{{ $t->created_at->format('d/m/Y H:i') }}</x-admin.td>
        <x-admin.td>
            <span class="block font-medium text-gray-900 text-sm truncate max-w-[240px]" title="{{ $t->nama }}">{{ $t->nama }}</span>
        </x-admin.td>
        <x-admin.td><span class="text-[13px] text-gray-600 tabular-nums whitespace-nowrap">{{ $t->no_hp }}</span></x-admin.td>
        <x-admin.td>
            @if($t->category)
            <span class="inline-flex items-center bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 rounded-full whitespace-nowrap">{{ $t->category }}</span>
            @else
            <span class="text-gray-400 text-sm">-</span>
            @endif
        </x-admin.td>
        <x-admin.td><span class="text-[13px] text-gray-600 whitespace-nowrap">{{ $t->device ?? '-' }}</span></x-admin.td>
        <x-admin.td>
            @if($t->customer)
            @include('admin.partials.status-changer', ['customer' => $t->customer])
            @else
            <x-admin.badge :color="$statusBadge[$t->status] ?? 'gray'">
                {{ $statusList[$t->status] ?? ucfirst((string) $t->status) }}
            </x-admin.badge>
            @endif
        </x-admin.td>
        <x-admin.td class="text-right sticky-col">
            <x-admin.actions destroy="admin.traffics.destroy" :params="[$t]" />
        </x-admin.td>
    </tr>
    @empty
    @php
        $isFiltering = collect(['search', 'status', 'device', 'date_from', 'date_to'])->contains(fn($n) => request()->filled($n));
    @endphp
    <x-admin.empty-state :colspan="8" :message="$isFiltering ? 'Data tidak ditemukan.' : 'Belum ada data traffic.'" />
    @endforelse
    <x-slot:footer>
        <div>{{ $traffics->links('vendor.pagination.admin') }}</div>
    </x-slot:footer>
</x-admin.table>
@endsection
