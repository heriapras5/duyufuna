@extends('layouts.admin')
@section('title', 'Leads')
@section('page_title', 'Leads')
@section('content')
@php
    $statusList = \App\Models\Customer::STATUSES;
@endphp

<x-admin.search route="admin.customers.index" placeholder="Cari nama, nomor, alamat...">
    <x-slot:filters>
        <select name="status" class="admin-input bg-white w-auto">
            <option value="">Semua Status</option>
            @foreach($statusList as $value => $text)
            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $text }}</option>
            @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="admin-input w-auto" title="Dari tanggal">
        <span class="text-xs text-gray-400 -mx-1">–</span>
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="admin-input w-auto" title="Sampai tanggal">
    </x-slot:filters>
    <x-slot:actions>
        @include('admin.partials.export-dropdown', [
            'excelRoute' => route('admin.customers.export-excel', request()->query()),
            'pdfRoute' => route('admin.customers.pdf-preview', request()->query()),
        ])
    </x-slot:actions>
</x-admin.search>

<x-admin.table id="leadsTable">
    <x-slot:head>
        <tr>
            <x-admin.th class="w-10 text-center">No</x-admin.th>
            <x-admin.th>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'dir' => request('sort') === 'created_at' && request('dir', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="inline-flex items-center gap-1 hover:text-emerald-600 transition">
                    Tanggal
                    @if(request('sort') === 'created_at')
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><path d="{{ request('dir') === 'asc' ? 'm18 15-6-6-6 6' : 'm6 9 6 6 6-6' }}"/></svg>
                    @endif
                </a>
            </x-admin.th>
            <x-admin.th>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'dir' => request('sort') === 'nama' && request('dir', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="inline-flex items-center gap-1 hover:text-emerald-600 transition">
                    Nama
                    @if(request('sort') === 'nama')
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><path d="{{ request('dir') === 'asc' ? 'm18 15-6-6-6 6' : 'm6 9 6 6 6-6' }}"/></svg>
                    @endif
                </a>
            </x-admin.th>
            <x-admin.th>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'no_hp', 'dir' => request('sort') === 'no_hp' && request('dir', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="inline-flex items-center gap-1 hover:text-emerald-600 transition">
                    No WhatsApp
                    @if(request('sort') === 'no_hp')
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><path d="{{ request('dir') === 'asc' ? 'm18 15-6-6-6 6' : 'm6 9 6 6 6-6' }}"/></svg>
                    @endif
                </a>
            </x-admin.th>
            <x-admin.th>Alamat</x-admin.th>
            <x-admin.th>Sumber</x-admin.th>
            <x-admin.th>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'dir' => request('sort') === 'status' && request('dir', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="inline-flex items-center gap-1 hover:text-emerald-600 transition">
                    Status
                    @if(request('sort') === 'status')
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><path d="{{ request('dir') === 'asc' ? 'm18 15-6-6-6 6' : 'm6 9 6 6 6-6' }}"/></svg>
                    @endif
                </a>
            </x-admin.th>
            <x-admin.th class="text-center sticky-col min-w-[120px]">Aksi</x-admin.th>
        </tr>
    </x-slot:head>
    @forelse($customers as $c)
    <tr class="border-b border-gray-50 transition">
        <x-admin.td class="text-center text-sm text-gray-500 tabular-nums">{{ $customers->firstItem() + $loop->index }}</x-admin.td>
        <x-admin.td class="text-[13px] text-gray-600 whitespace-nowrap tabular-nums">{{ $c->created_at->format('d/m/Y') }}</x-admin.td>
        <x-admin.td>
            <div class="min-w-0">
                <span class="font-medium text-gray-900 text-sm block truncate">{{ $c->nama }}</span>
            </div>
        </x-admin.td>
        <x-admin.td><span class="text-[13px] text-gray-600 tabular-nums whitespace-nowrap">{{ $c->no_hp }}</span></x-admin.td>
        <x-admin.td>
            <div class="max-w-[260px]">
                @if($c->alamat)
                <span class="block text-sm text-gray-700 truncate" title="{{ $c->alamat }}">{{ $c->alamat }}</span>
                @endif
            </div>
        </x-admin.td>
        <x-admin.td>
            @if($c->sumber)
            <span class="inline-flex items-center bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 rounded-full whitespace-nowrap">{{ $c->sumber }}</span>
            @else
            <span class="text-gray-400 text-sm">-</span>
            @endif
        </x-admin.td>
        <x-admin.td>
            @include('admin.partials.status-changer', [
                'customer' => $c,
                'filterStatus' => request('status'),
                'removeOnMismatch' => true,
            ])
        </x-admin.td>
        <x-admin.td class="text-right sticky-col">
            <x-admin.actions show="admin.customers.show" edit="admin.customers.edit" destroy="admin.customers.destroy" :params="[$c]" />
        </x-admin.td>
    </tr>
    @empty
    @php
        $isFiltering = collect(['search', 'status', 'date_from', 'date_to'])->contains(fn($n) => request()->filled($n));
    @endphp
    <x-admin.empty-state :colspan="8" :message="$isFiltering ? 'Data tidak ditemukan.' : 'Belum ada data lead.'" />
    @endforelse
    <x-slot:footer>
        <div class="flex flex-wrap items-center justify-between gap-3">
            @if($customers->hasPages())
            <div>{{ $customers->links('vendor.pagination.admin') }}</div>
            @endif
        </div>
    </x-slot:footer>
</x-admin.table>
@endsection
