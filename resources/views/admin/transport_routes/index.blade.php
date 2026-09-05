@extends('layouts.admin')
@section('title', 'Transportasi')
@section('page_title', '🚐 Transportasi')
@section('page_subtitle', 'Kelola rute & tarif armada')
@section('content')

@php
    $transportCat = \App\Models\Category::where('page_type', 'transport')->first();
    $services = \App\Models\Service::where('category_id', $transportCat?->id)
        ->where('status', true)->orderBy('title')->get();
@endphp

@if($transportCat)
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <a href="{{ route('admin.categories.show', $transportCat) }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kelola Armada ({{ $transportCat->name }})
    </a>
</div>
@endif

@if($transportCat)
<x-admin.card class="mb-6">
    <div class="flex items-center gap-2 mb-3">
        <h2 class="text-sm font-bold text-gray-900">Armada</h2>
        <span class="text-xs text-gray-400">— kendaraan yang tampil di halaman publik</span>
    </div>
    <div class="flex flex-wrap gap-2">
        @forelse($services as $svc)
        <span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 border border-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">
            {{ $svc->title }}
            @if($svc->capacityLabel())
            <span class="text-emerald-400 font-medium">· {{ $svc->capacityLabel() }}</span>
            @endif
        </span>
        @empty
        <p class="text-xs text-gray-400">Belum ada armada. Tambahkan layanan kendaraan pada kategori transportasi.</p>
        @endforelse
    </div>
</x-admin.card>
@endif

<div class="flex flex-wrap items-center justify-between gap-4 mb-4">
    <div>
        <h2 class="text-base font-bold text-gray-900">Rute &amp; Tarif</h2>
        <p class="text-xs text-gray-400 mt-0.5">{{ $routes->count() }} rute · {{ $routes->sum(fn($r) => $r->prices->whereNotNull('price')->count()) }} tarif tersimpan</p>
    </div>
    <x-admin.add-button route="admin.transport-routes.create" label="Tambah Rute" />
</div>

@if($routes->count() > 0)
<x-admin.card class="overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] uppercase tracking-wider text-gray-400 border-b border-gray-100">
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Kode</th>
                    <th class="px-4 py-3 font-semibold">Rute</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Tarif (SAR)</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Terisi</th>
                    <th class="px-4 py-3 font-semibold text-right whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($routes as $route)
                @php
                    $filled = $route->prices->whereNotNull('price');
                    $min = $filled->min('price');
                    $max = $filled->max('price');
                @endphp
                <tr class="hover:bg-gray-50/60 transition-colors">
                    <td class="px-4 py-3.5 whitespace-nowrap">
                        <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">{{ $route->code }}</span>
                    </td>
                    <td class="px-4 py-3.5">
                        <p class="font-semibold text-gray-900 text-[13px] leading-snug">{{ $route->pickup_label }} <span class="text-emerald-500">→</span> {{ $route->dropoff_label }}</p>
                    </td>
                    <td class="px-4 py-3.5 whitespace-nowrap tabular-nums">
                        @if($filled->count() > 0)
                        <span class="font-bold text-emerald-600">{{ number_format((float) $min, 0, ',', '.') }}</span>
                        @if($min != $max)
                        <span class="text-gray-300">–</span>
                        <span class="font-bold text-emerald-600">{{ number_format((float) $max, 0, ',', '.') }}</span>
                        @endif
                        @else
                        <span class="text-gray-300">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 whitespace-nowrap">
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-bold {{ $filled->count() === $services->count() && $services->count() > 0 ? 'bg-emerald-50 text-emerald-600' : ($filled->count() > 0 ? 'bg-amber-50 text-amber-600' : 'bg-gray-100 text-gray-400') }}">
                            {{ $filled->count() }}/{{ $services->count() }}
                        </span>
                    </td>
                    <td class="px-4 py-3.5 whitespace-nowrap text-right">
                        <div class="inline-flex items-center justify-end gap-1">
                            <a href="{{ route('admin.transport-routes.edit', $route) }}" title="Edit"
                               class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ route('admin.transport-routes.destroy', $route) }}')" title="Hapus"
                                    class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin.card>
@else
<x-admin.card>
    <div class="text-center py-10">
        <p class="text-sm font-semibold text-gray-500">Belum ada rute transportasi</p>
        <p class="text-xs text-gray-400 mt-1">Tambahkan rute pertama beserta tarif armadanya.</p>
        <a href="{{ route('admin.transport-routes.create') }}" class="btn btn-primary mt-4 inline-flex items-center gap-2">
            Tambah Rute
        </a>
    </div>
</x-admin.card>
@endif
@endsection
