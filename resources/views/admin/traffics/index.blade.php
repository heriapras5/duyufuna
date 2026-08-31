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

<x-admin.search route="admin.traffics.index" placeholder="{{ $type === 'leads' ? 'Cari nama, nomor, layanan...' : 'Cari halaman, menu, kategori, layanan...' }}">
    <x-slot:filters>
        <select name="type" class="admin-input bg-white w-auto">
            <option value="kunjungan" @selected($type === 'kunjungan')>Kunjungan</option>
            <option value="leads" @selected($type === 'leads')>Lead Events</option>
        </select>
        @if($type === 'leads')
        <select name="status" class="admin-input bg-white w-auto">
            <option value="">Semua Status</option>
            @foreach($statusList as $value => $text)
            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $text }}</option>
            @endforeach
        </select>
        @endif
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

@if($type === 'leads')
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
            @php $statusValue = $t->customer?->status ?: $t->status; @endphp
            <x-admin.badge :color="$statusBadge[$statusValue] ?? 'gray'">
                {{ $statusList[$statusValue] ?? ucfirst((string) $statusValue) }}
            </x-admin.badge>
        </x-admin.td>
        <x-admin.td class="text-right sticky-col">
            <x-admin.actions destroy="admin.traffics.destroy" :params="[$t]" />
        </x-admin.td>
    </tr>
    @empty
    @php
        $isFiltering = collect(['search', 'status', 'device', 'date_from', 'date_to'])->contains(fn($n) => request()->filled($n));
    @endphp
    <x-admin.empty-state :colspan="8" :message="$isFiltering ? 'Data tidak ditemukan.' : 'Belum ada data lead events.'" />
    @endforelse
    <x-slot:footer>
        <div>{{ $traffics->links('vendor.pagination.admin') }}</div>
    </x-slot:footer>
</x-admin.table>
@else
<x-admin.table>
    <x-slot:head>
        <tr>
            <x-admin.th class="w-10 text-center">No</x-admin.th>
            <x-admin.th class="min-w-[160px]">Waktu</x-admin.th>
            <x-admin.th class="min-w-[240px]">Halaman</x-admin.th>
            <x-admin.th class="min-w-[120px]">Menu</x-admin.th>
            <x-admin.th class="min-w-[150px]">Kategori / Layanan</x-admin.th>
            <x-admin.th class="min-w-[90px]">Device</x-admin.th>
            <x-admin.th class="min-w-[160px]">Referrer</x-admin.th>
            <x-admin.th class="min-w-[110px]">IP</x-admin.th>
            <x-admin.th class="text-right sticky-col min-w-[52px]">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($traffics as $t)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $traffics->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td class="text-[13px] text-gray-600 whitespace-nowrap tabular-nums">{{ $t->created_at->format('d/m/Y H:i') }}</x-admin.td>
        <x-admin.td>
            <a href="{{ $t->url }}" target="_blank" rel="noopener" class="block text-[13px] font-medium text-gray-800 hover:text-emerald-600 truncate max-w-[280px]" title="{{ $t->url }}">{{ $t->url }}</a>
        </x-admin.td>
        <x-admin.td><span class="text-[13px] text-gray-600 whitespace-nowrap">{{ $t->menu ?? '-' }}</span></x-admin.td>
        <x-admin.td>
            @if($t->category || $t->service)
            <span class="text-[13px] text-gray-600">{{ $t->category ?? '-' }}{{ $t->service ? ' · ' . $t->service : '' }}</span>
            @else
            <span class="text-gray-400 text-sm">-</span>
            @endif
        </x-admin.td>
        <x-admin.td><span class="text-[13px] text-gray-600 whitespace-nowrap">{{ $t->device ?? '-' }}</span></x-admin.td>
        <x-admin.td>
            @if($t->referrer)
            <span class="block text-[12px] text-gray-500 truncate max-w-[220px]" title="{{ $t->referrer }}">{{ $t->referrer }}</span>
            @else
            <span class="text-gray-400 text-sm">-</span>
            @endif
        </x-admin.td>
        <x-admin.td><span class="text-[12px] text-gray-500 tabular-nums">{{ $t->ip ?? '-' }}</span></x-admin.td>
        <x-admin.td class="text-right sticky-col">
            <x-admin.actions destroy="admin.traffics.destroy" :params="[$t]" />
        </x-admin.td>
    </tr>
    @empty
    @php
        $isFiltering = collect(['search', 'device', 'date_from', 'date_to'])->contains(fn($n) => request()->filled($n));
    @endphp
    <x-admin.empty-state :colspan="9" :message="$isFiltering ? 'Data tidak ditemukan.' : 'Belum ada kunjungan tercatat.'" />
    @endforelse
    <x-slot:footer>
        <div>{{ $traffics->links('vendor.pagination.admin') }}</div>
    </x-slot:footer>
</x-admin.table>
@endif
@endsection