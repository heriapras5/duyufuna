@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div id="dashboardApp" x-data="{ show: true }" x-transition.opacity.duration.600ms>

    {{-- ============ Indikator Loading (garis tipis, muncul saat fetch) ============ --}}
    <div id="dashLoadingBar" class="hidden wa-progress mb-4" aria-hidden="true"></div>

    {{-- ============ Filter Waktu (AJAX) ============ --}}
    <div id="dashFilterBar" class="bg-white border border-gray-200 border-l-4 border-emerald-500/30 rounded-xl shadow-sm px-4 py-3 mb-6 flex flex-wrap items-center gap-3">
        <span class="text-[11px] text-gray-500 font-medium flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
            <span>Filter waktu:</span>
        </span>
        <div class="flex flex-wrap items-center gap-2">
            @foreach(['harian' => 'Harian', 'mingguan' => 'Mingguan', 'bulanan' => 'Bulanan', 'tahunan' => 'Tahunan'] as $key => $label)
            <button type="button" data-period="{{ $key }}" class="period-btn px-3.5 py-1.5 text-xs lg:text-sm font-medium rounded-lg transition-colors {{ (!$hasCustomRange && $filter === $key) ? 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 shadow-sm' }}">
                {{ $label }}
            </button>
            @endforeach
        </div>
        <span class="hidden lg:inline text-gray-200">|</span>
        <div class="flex flex-wrap items-center gap-1.5">
            <span class="text-[11px] text-gray-500 font-medium whitespace-nowrap">Dari</span>
            <input type="date" id="filterFrom" value="{{ $from->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}" class="px-2 sm:px-3 py-1.5 text-xs sm:text-sm bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 text-gray-900 outline-none w-32 lg:w-auto flex-shrink-0">
            <span class="text-[11px] text-gray-500 font-medium whitespace-nowrap">Sampai</span>
            <input type="date" id="filterTo" value="{{ $to->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}" class="px-2 sm:px-3 py-1.5 text-xs sm:text-sm bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 text-gray-900 outline-none w-32 lg:w-auto flex-shrink-0">
            <button type="button" id="applyFilterBtn" class="btn btn-blue flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                <span>Filter</span>
            </button>
        </div>
        <div id="filterError" class="hidden w-full text-xs text-red-500 font-medium"></div>
    </div>

    {{-- ============ Info Bar Periode ============ --}}
    <div class="bg-white border border-gray-200 border-l-4 border-emerald-500/30 rounded-xl shadow-sm px-4 sm:px-5 py-3 mb-6 flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        <div class="flex items-center gap-3 text-sm text-gray-700">
            <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-emerald-600 text-white flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </span>
            <div class="leading-tight min-w-0">
                <span class="text-xs sm:text-sm font-semibold" id="infoFromDate">{{ $from->format('d M Y') }}</span>
                <span class="text-gray-300 mx-1">—</span>
                <span class="text-xs sm:text-sm font-semibold" id="infoToDate">{{ $to->format('d M Y') }}</span>
                <div class="text-[10px] sm:text-[11px] text-gray-400 mt-0.5" id="infoPeriodLabel">{{ $hasCustomRange ? 'Periode Ini' : $periodLabel }}</div>
            </div>
            <span class="hidden lg:inline text-[10px] text-gray-400 italic ml-1 max-w-[200px] leading-tight">Gunakan filter di atas untuk mengubah rentang waktu tampilan data</span>
        </div>
    </div>

    {{-- ============ BAGIAN A: Ringkasan Data ============ --}}
    <section class="space-y-3 mb-6">
        <div class="flex items-center gap-2">
            <span class="h-5 w-1.5 rounded-full bg-emerald-600"></span>
            <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Ringkasan Data</h2>
            <span class="text-[10px] sm:text-[11px] text-gray-400 italic hidden sm:inline" id="summarySub">· {{ $periodLabel }}</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-stretch">
            <x-admin.stat-card label="Visitor {{ $periodLabel }}" :value="number_format($periodVisitors, 0, ',', '.')" tone="blue"
                label-id="cardVisitorLabel"
                hint-id="cardVisitorHint"
                value-id="cardVisitorValue"
                delta-id="cardVisitorDelta"
                footer-id="cardVisitorTotalFooter"
                hint="IP unik per hari · {{ $periodLabelLower }}"
                footer="Total {{ number_format($totalVisitors, 0, ',', '.') }}"
                :delta="$visitorChange" :delta-positive="$visitorChange >= 0">
                <x-slot:icon><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Traffic {{ $periodLabel }}" :value="number_format($periodTraffic, 0, ',', '.')" tone="amber"
                label-id="cardTrafficLabel"
                hint-id="cardTrafficHint"
                value-id="cardTrafficValue"
                delta-id="cardTrafficDelta"
                footer-id="cardTrafficTotalFooter"
                hint="Pengisi form, {{ $periodLabelLower }} · terekam per layanan"
                footer="Total {{ number_format($totalTraffic, 0, ',', '.') }}"
                :delta="$trafficChange" :delta-positive="$trafficChange >= 0">
                <x-slot:icon><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Leads {{ $periodLabel }}" :value="number_format($periodLeads, 0, ',', '.')" tone="green"
                label-id="cardLeadsLabel"
                hint-id="cardLeadsHint"
                value-id="cardLeadsValue"
                delta-id="cardLeadsDelta"
                footer-id="cardLeadsTotalFooter"
                hint="Pengisi form, no HP unik · {{ $periodLabelLower }}"
                footer="Total {{ number_format($totalLeads, 0, ',', '.') }}"
                :delta="$leadChange" :delta-positive="$leadChange >= 0">
                <x-slot:icon><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Total Traffic" :value="number_format($totalTraffic, 0, ',', '.')" tone="violet"
                value-id="cardTotalTraffic"
                footer-id="cardTotalTrafficFooter"
                footer="{{ $periodTraffic }} {{ $periodLabelLower }}">
                <x-slot:icon><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Total Leads" :value="number_format($totalLeads, 0, ',', '.')" tone="teal"
                value-id="cardTotalLeads"
                footer-id="cardTotalLeadsFooter"
                footer="{{ $periodLeads }} baru {{ $periodLabelLower }}">
                <x-slot:icon><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Layanan Aktif" :value="number_format($totalServicesActive, 0, ',', '.')" tone="rose"
                value-id="cardServicesValue"
                footer="Total layanan tersedia">
                <x-slot:icon><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></x-slot:icon>
            </x-admin.stat-card>
        </div>
    </section>

    {{-- ============ BAGIAN B: Grafik & Status ============ --}}
    <section class="space-y-3 mb-6">
        <div class="flex items-center gap-2">
            <span class="h-5 w-1.5 rounded-full bg-emerald-600"></span>
            <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Grafik &amp; Status</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
                <div class="p-5 pb-1 flex-1 flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                            Tren Aktivitas
                        </h3>
                        <a href="{{ route('admin.traffics.index') }}" class="text-[11px] sm:text-xs text-emerald-600 hover:text-emerald-700 font-medium whitespace-nowrap">Lihat Semua &rarr;</a>
                    </div>
                    <p class="text-[10px] text-gray-400 italic mt-1 mb-3">Perbandingan Visitor, Traffic &amp; Leads per periode</p>
                    <div id="trendChart" class="relative flex-1 min-h-[280px]"></div>
                    <div id="trendLegend" class="flex flex-wrap items-center justify-center gap-x-4 pt-3 pb-1 text-xs text-gray-500 border-t border-gray-100 mt-3"></div>
                </div>
                <div class="h-1.5 rounded-b-xl bg-emerald-600"></div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                            Sumber Konsultasi
                        </h3>
                        <a href="{{ route('admin.traffics.index') }}" class="text-[11px] sm:text-xs text-emerald-600 hover:text-emerald-700 font-medium whitespace-nowrap">Lihat Semua &rarr;</a>
                    </div>
                    <p class="text-[10px] text-gray-400 italic mt-1 mb-3">Distribusi kategori layanan pada periode terpilih</p>
                    <div id="sumberChart" class="relative flex-1 min-h-[260px] flex items-center justify-center"></div>
                    <div id="sumberSummary" class="grid grid-cols-2 gap-x-4 gap-y-2 pt-3 border-t border-gray-100 mt-3 text-xs text-gray-500"></div>
                </div>
                <div class="h-1.5 rounded-b-xl bg-emerald-600"></div>
            </div>
        </div>
    </section>

    {{-- ============ BAGIAN C: Leads Terbaru ============ --}}
    <section class="space-y-3 mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="h-5 w-1.5 rounded-full bg-emerald-600"></span>
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Leads Terbaru</h2>
            </div>
            <a href="{{ route('admin.customers.index') }}" class="text-[11px] sm:text-xs text-emerald-600 hover:text-emerald-700 font-medium whitespace-nowrap">Lihat Semua &rarr;</a>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <p class="px-4 sm:px-5 pt-3 text-[11px] text-gray-500 italic">10 leads terbaru</p>
            <div class="divide-y divide-gray-50" id="recentLeadsList">
                @forelse($recentLeads as $c)
                @php($badgeCls = [
                    'baru' => 'bg-amber-500 text-white',
                    'pelanggan' => 'bg-emerald-500 text-white',
                    'dihubungi' => 'bg-sky-500 text-white',
                    'konversi' => 'bg-emerald-600 text-white',
                    'batal' => 'bg-red-500 text-white',
                ][$c['status']] ?? 'bg-gray-500 text-white')
                <div class="flex items-center justify-between gap-3 px-3 sm:px-4 py-3">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $c['nama'] }}</p>
                        <p class="mt-0.5 flex items-center gap-1.5 text-sm text-gray-700 truncate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>{{ $c['no_hp'] }}@if(($c['counts'] ?? 1) > 1) &middot; dikirim {{ $c['counts'] }}x @endif</span>
                        </p>
                        @if(!empty($c['layanan']) || !empty($c['item']))
                        <p class="text-xs text-gray-500 truncate">{{ $c['layanan'] }}@if(!empty($c['layanan']) && !empty($c['item'])) - @endif{{ $c['item'] }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col items-end gap-1 flex-shrink-0 ml-2">
                        <span class="inline-flex items-center justify-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-xs font-medium leading-none {{ $badgeCls }}"><span class="w-1.5 h-1.5 rounded-full inline-block flex-shrink-0 opacity-75" style="background:currentColor"></span>{{ \App\Models\Customer::STATUSES[$c['status']] ?? ucfirst((string) $c['status']) }}</span>
                        <div class="flex items-center justify-end gap-1.5 min-w-0">
                            @if(!empty($c['sumber']))
                            <span class="inline-flex items-center bg-emerald-50 text-dark-green text-[11px] font-semibold rounded-full px-2.5 py-1 whitespace-nowrap">{{ $c['sumber'] }}</span>
                            @endif
                            <span class="text-xs text-gray-500 whitespace-nowrap text-right tabular-nums">{{ $c['waktu'] }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-5 py-10 text-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-2 block"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                    <p class="text-sm">Belum ada leads pada periode ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
    var STATUS_CONFIG = @json(\App\Models\Customer::STATUSES);
    var LEAD_SHOW_URL = '{{ route('admin.customers.show', ':id') }}';

    function fmtNum(v) {
        return Number(v).toLocaleString('id-ID');
    }

    function setText(id, val) {
        var el = document.getElementById(id);
        if (el) el.textContent = val;
    }

    function setHtml(id, val) {
        var el = document.getElementById(id);
        if (el) el.innerHTML = val;
    }

    function animateValue(el, start, target, duration) {
        if (!el) return;
        var startTime = null;
        var dur = duration || 700;
        function step(ts) {
            if (startTime === null) startTime = ts;
            var p = Math.min((ts - startTime) / dur, 1);
            var eased = 1 - Math.pow(1 - p, 3);
            el.textContent = fmtNum(Math.round(start + (target - start) * eased));
            if (p < 1) requestAnimationFrame(step);
            else el.textContent = fmtNum(target);
        }
        requestAnimationFrame(step);
    }

    function setValue(id, num) {
        var el = document.getElementById(id);
        if (!el) return;
        var start = parseInt(el.textContent.replace(/\./g, ''), 10) || 0;
        animateValue(el, start, num, 600);
    }

    function animateCardValues(ids) {
        ids.forEach(function (id) {
            var el = document.getElementById(id);
            if (!el) return;
            var target = parseInt(el.textContent.replace(/\./g, ''), 10) || 0;
            animateValue(el, 0, target, 800);
        });
    }

    function updateDelta(id, pct, positive) {
        var el = document.getElementById(id);
        if (!el) return;
        el.className = 'mt-2 text-xs font-semibold flex items-center gap-1 ' + (positive ? 'text-emerald-600' : 'text-red-500');
        var up = positive ? 'm7 17 10-10' : 'm7 7 10 10';
        var tail = positive ? 'M9 7h8v8' : 'M9 17h8V9';
        el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="' + up + '"/><path d="' + tail + '"/></svg> ' + pct + '% vs periode lalu';
    }

    function highlightPeriod(period, hasCustom) {
        document.querySelectorAll('.period-btn').forEach(function (btn) {
            var active = !hasCustom && btn.dataset.period === period;
            btn.className = 'period-btn px-3.5 py-1.5 text-xs lg:text-sm font-medium rounded-lg transition-colors '
                + (active ? 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 shadow-sm');
        });
    }

    function esc(s) {
        var d = document.createElement('div');
        d.textContent = s == null ? '' : String(s);
        return d.innerHTML;
    }

    var STATUS_BADGE_COLORS = {
        baru: 'bg-amber-500 text-white',
        pelanggan: 'bg-emerald-500 text-white',
        dihubungi: 'bg-sky-500 text-white',
        konversi: 'bg-emerald-600 text-white',
        batal: 'bg-red-500 text-white'
    };
    var STATUS_BADGE = {};
    Object.keys(STATUS_CONFIG).forEach(function(k) {
        STATUS_BADGE[k] = [STATUS_CONFIG[k], STATUS_BADGE_COLORS[k] || 'bg-gray-500 text-white'];
    });

    function renderRecentLeads(list) {
        var el = document.getElementById('recentLeadsList');
        if (!el) return;
        list = list || [];
        if (!list.length) {
            el.innerHTML = '<div class="px-5 py-10 text-center text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-2 block"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg><p class="text-sm">Belum ada leads pada periode ini.</p></div>';
            return;
        }
        var html = '';
        list.forEach(function (c) {
            var sb = STATUS_BADGE[c.status] || ['', 'bg-gray-500 text-white'];
            var detail = '';
            if (c.layanan || c.item) {
                detail = '<p class="text-xs text-gray-500 truncate">' + esc(c.layanan || '') + (c.layanan && c.item ? ' - ' : '') + esc(c.item || '') + '</p>';
            }
            html += '<div class="flex items-center justify-between gap-3 px-3 sm:px-4 py-3">'
                + '<div class="min-w-0 flex-1">'
                + '<p class="text-sm font-semibold text-gray-900 truncate">' + esc(c.nama) + '</p>'
                + '<p class="mt-0.5 flex items-center gap-1.5 text-sm text-gray-700 truncate">'
                + '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>'
                + '<span>' + esc(c.no_hp) + (c.counts > 1 ? ' &middot; dikirim ' + c.counts + 'x' : '') + '</span>'
                + '</p>'
                + detail
                + '</div>'
                + '<div class="flex flex-col items-end gap-1 flex-shrink-0 ml-2">'
                + '<span class="inline-flex items-center justify-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-xs font-medium leading-none ' + sb[1] + '"><span class="w-1.5 h-1.5 rounded-full inline-block flex-shrink-0 opacity-75" style="background:currentColor"></span>' + sb[0] + '</span>'
                + '<div class="flex items-center justify-end gap-1.5 min-w-0">'
                + (c.sumber ? '<span class="inline-flex items-center bg-emerald-50 text-dark-green text-[11px] font-semibold rounded-full px-2.5 py-1 whitespace-nowrap">' + esc(c.sumber) + '</span>' : '')
                + '<span class="text-xs text-gray-500 whitespace-nowrap text-right tabular-nums">' + esc(c.waktu) + '</span>'
                + '</div>'
                + '</div></div>';
        });
        el.innerHTML = html;
    }

    var currentData = null;
    var fetchBusy = false;
    var lastParams = null;

    function setFilterBusy(value) {
        fetchBusy = value;
        document.querySelectorAll('.period-btn, #applyFilterBtn').forEach(function (el) {
            el.disabled = value;
            el.classList.toggle('opacity-60', value);
            el.classList.toggle('pointer-events-none', value);
        });
        var apply = document.getElementById('applyFilterBtn');
        if (apply) {
            apply.innerHTML = value
                ? '<svg class="animate-spin h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg><span>Memuat...</span>'
                : '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg><span>Filter</span>';
        }
        var bar = document.getElementById('dashLoadingBar');
        if (bar) bar.classList.toggle('hidden', !value);

        document.querySelectorAll('.stat-value-text').forEach(function(el) {
            if (value) {
                el.classList.add('animate-pulse', 'bg-gray-200', 'text-transparent', 'rounded-md', 'w-20', 'h-8', 'inline-block');
                el.classList.remove('text-gray-900');
            } else {
                el.classList.remove('animate-pulse', 'bg-gray-200', 'text-transparent', 'rounded-md', 'w-20', 'h-8', 'inline-block');
                el.classList.add('text-gray-900');
            }
        });
    }

    function dashboardFetch(params) {
        if (fetchBusy) return;
        setFilterBusy(true);
        var url = '{{ route('admin.dashboard.data') }}?' + new URLSearchParams(params).toString();
        fetch(url)
            .then(function (r) {
                if (r.status === 401 || r.status === 419) {
                    window.location.href = '{{ route('login') }}';
                    throw new Error('Sesi berakhir.');
                }
                if (!r.ok) throw new Error('Response ' + r.status);
                return r.json();
            })
            .then(function (d) {
                lastParams = params;
                var qs = new URLSearchParams(params).toString();
                history.replaceState(null, '', '{{ route('admin.dashboard') }}' + (qs ? '?' + qs : ''));
                updateDom(d);
            })
            .catch(function (e) {
                console.error('Dashboard fetch error:', e);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Gagal memuat data dashboard', showConfirmButton: false, timer: 3000 });
                }
            })
            .finally(function () { setFilterBusy(false); });
    }

    function updateDom(d) {
        currentData = d;
        setText('summarySub', '· ' + d.periodLabel);

        setText('infoFromDate', d.fromDate || '');
        setText('infoToDate', d.toDate || '');
        setText('infoPeriodLabel', d.hasCustomRange ? 'Periode Ini' : d.periodLabel);

        setText('cardTrafficLabel', 'Traffic ' + d.periodLabel);
        setText('cardTrafficHint', 'Pengisi form, ' + d.periodLabelLower + ' · terekam per layanan');
        setValue('cardTrafficValue', d.periodTraffic);
        updateDelta('cardTrafficDelta', d.trafficChange, d.trafficChange >= 0);

        setText('cardLeadsLabel', 'Leads ' + d.periodLabel);
        setText('cardLeadsHint', 'Pengisi form, no HP unik · ' + d.periodLabelLower);
        setValue('cardLeadsValue', d.periodLeads);
        updateDelta('cardLeadsDelta', d.leadChange, d.leadChange >= 0);

        setValue('cardTotalTraffic', d.totalTraffic);
        setText('cardTotalTrafficFooter', d.periodTraffic + ' ' + d.periodLabelLower);
        setValue('cardTotalLeads', d.totalLeads);
        setText('cardTotalLeadsFooter', d.periodLeads + ' baru ' + d.periodLabelLower);
        setText('cardVisitorLabel', 'Visitor ' + d.periodLabel);
        setText('cardVisitorHint', 'IP unik per hari · ' + d.periodLabelLower);
        setValue('cardVisitorValue', d.periodVisitors);
        updateDelta('cardVisitorDelta', d.visitorChange, d.visitorChange >= 0);

        setText('cardVisitorTotalFooter', 'Total ' + d.totalVisitors.toLocaleString('id-ID'));
        setText('cardTrafficTotalFooter', 'Total ' + d.totalTraffic.toLocaleString('id-ID'));
        setText('cardLeadsTotalFooter', 'Total ' + d.totalLeads.toLocaleString('id-ID'));

        var f = document.getElementById('filterFrom');
        var t = document.getElementById('filterTo');
        if (f) f.value = d.fromDateInput;
        if (t) t.value = d.toDateInput;

        highlightPeriod(d.filter, d.hasCustomRange);

        renderRecentLeads(d.recentLeads);

        renderCharts(d);
    }

    var TREND_SERIES = [
        { label: 'Visitor', key: 'visitorChartData', color: '#1D4ED8' },
        { label: 'Traffic', key: 'trafficChartData', color: '#C9A227' },
        { label: 'Leads', key: 'leadChartData', color: '#0E9F6E' },
    ];

    function trendOptions(d) {
        var isDay = d.trendStep === 'day';
        return {
            type: 'bar',
            data: {
                labels: d.visitorChartCategories,
                datasets: TREND_SERIES.map(function (s) {
                    return { label: s.label, data: d[s.key], backgroundColor: s.color, borderRadius: 3, borderSkipped: false, maxBarThickness: isDay ? 26 : 12, barPercentage: 0.85, categoryPercentage: 0.75 };
                })
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: function (c) { return ' ' + c.dataset.label + ': ' + c.parsed.y.toLocaleString('id-ID'); } } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#9CA3AF', font: { size: 11 }, maxRotation: 45 } },
                    y: { position: 'left', beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { color: '#9CA3AF', font: { size: 11 }, precision: 0, callback: function (v) { return v.toLocaleString('id-ID'); } } }
                }
            }
        };
    }

    function doughnutOptions(labels, data, colors) {
        return {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{ data: data, backgroundColor: colors, borderWidth: 2, borderColor: '#ffffff' }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: { title: { display: false }, callbacks: { label: function (c) { return ' ' + c.parsed.toLocaleString('id-ID') + ' konsultasi'; } } }
                }
            }
        };
    }

    var SUMBER_PALETTE = ['#0E9F6E', '#1D4ED8', '#C9A227', '#7C3AED', '#64748B'];

    function renderSumberSummary(d) {
        var el = document.getElementById('sumberSummary');
        if (!el) return;
        var labels = d.visitsBySumberLabels || [];
        var total = labels.reduce(function (s, l) { return s + (d.visitsBySumber[l] || 0); }, 0);
        if (!total) { el.innerHTML = ''; return; }
        var items = labels.map(function (l, i) {
            var v = d.visitsBySumber[l] || 0;
            var pct = Math.round((v / total) * 100);
            return '<div class="flex items-center gap-2 text-xs text-gray-500 min-w-0" title="' + esc(l) + ': ' + v.toLocaleString('id-ID') + ' konsultasi">'
                + '<span class="inline-block w-2.5 h-2.5 rounded-sm flex-shrink-0" style="background:' + SUMBER_PALETTE[i % SUMBER_PALETTE.length] + '"></span>'
                + '<span class="truncate">' + esc(l) + '</span>'
                + '<span class="ml-auto font-medium text-gray-700 tabular-nums">' + pct + '%</span>'
                + '</div>';
        }).join('');
        el.innerHTML = items;
    }

    function renderTrendLegend(d) {
        var el = document.getElementById('trendLegend');
        if (!el) return;
        var html = TREND_SERIES.map(function (s) {
            var vals = d[s.key] || [];
            var total = vals.reduce(function (a, b) { return a + b; }, 0);
            return '<span class="flex items-center gap-1.5 whitespace-nowrap"><span class="inline-block w-3 h-3 rounded-sm" style="background:' + s.color + '"></span> ' + s.label + ' <b class="font-semibold text-gray-700 tabular-nums">' + total.toLocaleString('id-ID') + '</b></span>';
        }).join('');
        el.innerHTML = html;
    }

    function sumberOptions(d) {
        var cols = SUMBER_PALETTE;
        var colors = d.visitsBySumberLabels.map(function (_, i) { return cols[i % cols.length]; });
        var data = d.visitsBySumberLabels.map(function (l) { return d.visitsBySumber[l]; });
        return doughnutOptions(d.visitsBySumberLabels, data, colors);
    }

    function emptyMessage(id, text) {
        var el = document.getElementById(id);
        if (el) el.innerHTML = '<div class="flex flex-col items-center justify-center h-full py-10 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg><p class="text-sm text-gray-400 max-w-xs">' + text + '</p></div>';
    }

    var chartInstances = {};

    function buildChart(id, config, isEmpty, emptyText) {
        var el = document.getElementById(id);
        if (!el) return;
        if (isEmpty) {
            emptyMessage(id, emptyText);
            return;
        }
        el.innerHTML = '<canvas></canvas>';
        try {
            chartInstances[id] = new Chart(el.querySelector('canvas'), config);
        } catch (e) {
            console.error('Chart init error:', e);
        }
    }

    function destroyCharts() {
        Object.keys(chartInstances).forEach(function (k) {
            if (chartInstances[k]) { chartInstances[k].destroy(); chartInstances[k] = null; }
        });
    }

    function renderCharts(d) {
        if (typeof Chart === 'undefined') {
            ['trendChart', 'sumberChart'].forEach(function (id) {
                emptyMessage(id, 'Grafik tidak dapat dimuat (library chart belum tersedia).');
            });
            return;
        }
        try {
            destroyCharts();
            var trendEmpty = TREND_SERIES.every(function (s) {
                return (d[s.key] || []).reduce(function (a, b) { return a + b; }, 0) === 0;
            });
            buildChart('trendChart', trendOptions(d), trendEmpty, 'Belum ada data pada periode ini.');
            buildChart('sumberChart', sumberOptions(d), Object.keys(d.visitsBySumber).length === 0, 'Belum ada konsultasi pada periode ini.');
            renderSumberSummary(d);
            renderTrendLegend(d);
        } catch (e) {
            console.error('Chart render error:', e);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        currentData = {
            visitorChartCategories: @json($leadChartCategories),
            visitorChartData: @json($visitorChartData),
            trafficChartData: @json($trafficChartData),
            leadChartData: @json($leadChartData),
            trendStep: @json($trendStep),
            visitsBySumber: @json($visitsBySumber),
            visitsBySumberLabels: @json($visitsBySumberLabels),
            filter: @json($filter),
            hasCustomRange: @json($hasCustomRange),
            periodLabel: @json($periodLabel),
            periodLabelLower: @json($periodLabelLower),
            periodVisitors: @json($periodVisitors),
            periodTraffic: @json($periodTraffic),
            periodLeads: @json($periodLeads),
            recentLeads: @json($recentLeads)
        };

        if (@json($hasCustomRange)) {
            lastParams = {
                date_from: document.getElementById('filterFrom').value,
                date_to: document.getElementById('filterTo').value,
            };
        } else {
            lastParams = { filter: @json($filter) };
        }

        highlightPeriod(currentData.filter, currentData.hasCustomRange);
        renderRecentLeads(currentData.recentLeads);

        document.querySelectorAll('.period-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                dashboardFetch({ filter: this.dataset.period });
            });
        });

        document.getElementById('applyFilterBtn').addEventListener('click', function () {
            var from = document.getElementById('filterFrom').value;
            var to = document.getElementById('filterTo').value;
            var error = document.getElementById('filterError');
            var message = '';
            if (!from || !to) {
                message = 'Harap isi tanggal Dari dan Sampai terlebih dahulu.';
            } else if (from > to) {
                message = 'Tanggal "Dari" tidak boleh lebih besar dari tanggal "Sampai".';
            }
            if (message) {
                error.textContent = message;
                error.classList.remove('hidden');
                return;
            }
            error.classList.add('hidden');
            dashboardFetch({ date_from: from, date_to: to });
        });

        animateCardValues(['cardTrafficValue', 'cardLeadsValue', 'cardServicesValue', 'cardVisitorValue', 'cardTotalTraffic', 'cardTotalLeads']);

        renderCharts(currentData);
    });
    </script>
@endpush
