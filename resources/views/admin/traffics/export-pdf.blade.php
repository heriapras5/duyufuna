<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Export Data Traffic - DUYUFUNA</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; color: #111827; font-size: 10px; }
        .header { display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 2px solid #005C3B; padding-bottom: 8px; margin-bottom: 12px; }
        .header h1 { margin: 0; font-size: 18px; color: #005C3B; }
        .header p { margin: 2px 0 0; color: #6B7280; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #E5E7EB; padding: 5px 6px; text-align: left; vertical-align: top; }
        th { background: #005C3B; color: #ffffff; font-weight: bold; font-size: 9px; text-transform: uppercase; letter-spacing: 0.02em; }
        td.num, th.num { text-align: center; width: 28px; }
        td.time, th.time { white-space: nowrap; width: 96px; }
        .striped tr:nth-child(even) { background: #FAFAFA; }
        .empty { padding: 40px; text-align: center; color: #9CA3AF; }
        .meta { margin-top: 12px; font-size: 11px; color: #4B5563; }
        .small { font-size: 9px; color: #4B5563; word-break: break-all; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>Data Traffic (Form Konsultasi)</h1>
            <p>DUYUFUNA Travel Umroh &amp; Haji</p>
        </div>
        <p>Diekspor pada: {{ $exportedAt }}</p>
    </div>

    @if($traffics->isEmpty())
    <div class="empty">Tidak ada data traffic untuk diexport.</div>
    @else
    <table class="striped">
        <thead>
            <tr>
                <th class="num">No</th>
                <th class="time">Waktu</th>
                <th>Nama</th>
                <th>No WhatsApp</th>
                <th>Kategori Layanan</th>
                <th>Layanan</th>
                <th>Item</th>
                <th>Asal Kunjungan</th>
                <th>Device</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($traffics as $i => $t)
            <tr>
                <td class="num">{{ $i + 1 }}</td>
                <td class="time">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $t->nama }}</td>
                <td>{{ $t->no_hp }}</td>
                <td>{{ $t->category ?? '-' }}</td>
                <td>{{ $t->service ?? '-' }}</td>
                <td>{{ $t->item ?? '-' }}</td>
                <td class="small">{{ $t->referrer ?? '-' }}</td>
                <td>{{ $t->device ?? '-' }}</td>
                <td>{{ \App\Models\Customer::STATUSES[$t->status] ?? ucfirst((string) $t->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="meta">Total: <strong>{{ $traffics->count() }}</strong> data &nbsp;·&nbsp; Sumber: Form konsultasi layanan</div>
</body>
</html>
