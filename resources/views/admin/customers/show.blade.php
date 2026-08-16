@extends('layouts.admin')
@section('title', 'Detail Lead - ' . $customer->nama)
@section('page_title', 'Detail Lead')
@section('content')
@php
    $statusList = \App\Models\Customer::STATUSES;
    $statusColor = \App\Models\Customer::STATUS_COLORS;
    $currentStatus = $customer->status;
    $statusSymbol = [
        'baru' => 'sparkle',
        'dihubungi' => 'phone',
        'pelanggan' => 'user',
        'konversi' => 'check',
        'batal' => 'x',
    ];
    $statusDot = [
        'baru' => 'bg-amber-400',
        'dihubungi' => 'bg-sky-400',
        'pelanggan' => 'bg-emerald-400',
        'konversi' => 'bg-[#065f46]',
        'batal' => 'bg-red-400',
    ];
    $totalKonsultasi = (int) $customer->counts + 1;
@endphp

<div class="flex items-center justify-between gap-4 mb-6 flex-wrap">
    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
    <div class="flex items-center gap-2 flex-wrap">
        <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/></svg>
            WhatsApp
        </a>
        <a href="{{ $telUrl }}" class="btn btn-secondary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            Telepon
        </a>
        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-secondary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
            Edit Lead
        </a>
    </div>
</div>

<x-admin.card>
    <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4">
        <div class="min-w-0">
            <h2 class="text-xl font-bold text-gray-900 break-words">{{ $customer->nama }}</h2>
            <div class="flex items-center gap-2.5 mt-2 flex-wrap text-xs text-gray-500">
                @if($customer->sumber)
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-dark-green text-[11px] font-semibold px-2.5 py-1 rounded-full whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    {{ $customer->sumber }}
                </span>
                @endif
                <span class="inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    {{ $totalKonsultasi }}x konsultasi
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
                    {{ $customer->created_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>
        <div class="shrink-0">
            @include('admin.partials.status-changer', ['customer' => $customer, 'onAfterSave' => 'appendStatusHistory'])
        </div>
    </div>
</x-admin.card>

<div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <x-admin.card title="Data Kontak">
            <div class="space-y-5">
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">No WhatsApp</dt>
                    <dd class="mt-1">
                        <a href="{{ $telUrl }}" class="text-sm text-dark-green font-semibold tabular-nums hover:underline inline-flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            {{ $customer->no_hp }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">Sumber</dt>
                    <dd class="mt-1 text-sm text-gray-700">{{ $customer->sumber ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">Tanggal Rekam</dt>
                    <dd class="mt-1 text-sm text-gray-700 tabular-nums">{{ $customer->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">Total Konsultasi</dt>
                    <dd class="mt-1 text-sm text-gray-700 tabular-nums">{{ $totalKonsultasi }}x
                        @if($customer->counts > 0)
                        <span class="text-xs text-gray-400">({{ $customer->counts }}x pengulangan)</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">Alamat</dt>
                    <dd class="mt-1 text-sm text-gray-700 leading-relaxed">{{ $customer->alamat ?? '-' }}</dd>
                </div>
            </div>
        </x-admin.card>
    </div>

    <div class="lg:col-span-2">
        <x-admin.card title="Riwayat Status">
            <div class="space-y-5" id="statusTimeline">
                @forelse($customer->histories as $history)
                <div class="flex gap-4">
                    <div class="flex flex-col items-center w-8 shrink-0">
                        <span @class(['flex h-6 w-6 items-center justify-center rounded-full ring-4 ring-white shrink-0 text-white', $statusDot[$history->status] ?? 'bg-gray-300'])>
                            @switch($statusSymbol[$history->status] ?? null)
                                @case('sparkle')
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/></svg>
                                @break
                                @case('phone')
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                @break
                                @case('user')
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                @break
                                @case('check')
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                @break
                                @case('x')
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                @break
                                @default
                                <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                            @endswitch
                        </span>
                        @if(!$loop->last)<span class="w-px flex-1 bg-gray-200 mt-2"></span>@endif
                    </div>
                    <div class="pb-1 min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex rounded-full border px-2.5 py-0.5 text-[11px] font-medium {{ $statusColor[$history->status] ?? 'text-gray-600 bg-gray-100 border-gray-200' }}">
                                {{ $statusList[$history->status] ?? ucfirst($history->status) }}
                            </span>
                            <span class="ml-auto whitespace-nowrap text-xs text-gray-400 tabular-nums">
                                {{ $history->created_at->format('d M Y H:i') }}
                                @if($history->user)
                                <span class="text-gray-400">· oleh <span class="font-medium text-gray-600">{{ $history->user->name }}</span></span>
                                @endif
                            </span>
                        </div>
                        @if(trim((string) $history->catatan) !== '')
                        <p class="mt-2 text-sm text-gray-600 bg-gray-50 rounded-lg border border-gray-100 px-3.5 py-2.5 leading-relaxed">{{ $history->catatan }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <div id="statusEmpty" class="text-center py-10">
                    <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <p class="text-sm text-gray-400">Belum ada riwayat perubahan status.</p>
                </div>
                @endforelse
            </div>
        </x-admin.card>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var statusHistoryMeta = {
        list: {{ Js::from($statusList) }},
        colors: {{ Js::from($statusColor) }},
        dots: {{ Js::from($statusDot) }},
        adminName: {{ Js::from(Auth::user()->name) }},
        icons: {
            'baru': '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/></svg>',
            'dihubungi': '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
            'pelanggan': '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
            'konversi': '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
            'batal': '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
        },
    };

    function appendStatusHistory(statusKey, catatan) {
        var meta = statusHistoryMeta;
        function escapeHtml(s) {
            return String(s == null ? '' : s)
                .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        }
        var el = document.getElementById('statusTimeline');
        if (!el) return;
        var empty = document.getElementById('statusEmpty');
        if (empty) empty.remove();

        var icon = meta.icons[statusKey] || '<span class="h-1.5 w-1.5 rounded-full bg-white"></span>';
        var now = new Date();
        function p(n) { return (n < 10 ? '0' : '') + n; }
        var waktu = p(now.getDate()) + '/' + p(now.getMonth() + 1) + '/' + now.getFullYear()
            + ' ' + p(now.getHours()) + ':' + p(now.getMinutes());

        var node = document.createElement('div');
        node.className = 'flex gap-4';
        node.innerHTML = '<div class="flex flex-col items-center w-8 shrink-0">'
            + '<span class="flex h-6 w-6 items-center justify-center rounded-full ring-4 ring-white shrink-0 text-white ' + (meta.dots[statusKey] || 'bg-gray-300') + '">' + icon + '</span>'
            + '<span class="w-px flex-1 bg-gray-200 mt-2"></span>'
            + '</div>'
            + '<div class="pb-1 min-w-0 flex-1">'
            + '<div class="flex items-center gap-2">'
            + '<span class="inline-flex rounded-full border px-2.5 py-0.5 text-[11px] font-medium ' + (meta.colors[statusKey] || 'text-gray-600 bg-gray-100 border-gray-200') + '">' + (meta.list[statusKey] || statusKey) + '</span>'
            + '<span class="ml-auto whitespace-nowrap text-xs text-gray-400 tabular-nums">' + waktu + ' <span class="text-gray-400">· oleh <span class="font-medium text-gray-600">' + meta.adminName + '</span></span></span>'
            + '</div>'
            + (catatan ? '<p class="mt-2 text-sm text-gray-600 bg-gray-50 rounded-lg border border-gray-100 px-3.5 py-2.5 leading-relaxed">' + escapeHtml(catatan) + '</p>' : '')
            + '</div>';
        el.insertBefore(node, el.firstChild);
    }
</script>
@endpush
