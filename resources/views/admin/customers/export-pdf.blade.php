<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Export Data Leads - DUYUFUNA</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; color: #111827; font-size: 12px; }
        .header { display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 2px solid #005C3B; padding-bottom: 8px; margin-bottom: 12px; }
        .header h1 { margin: 0; font-size: 18px; color: #005C3B; }
        .header p { margin: 2px 0 0; color: #6B7280; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #E5E7EB; padding: 6px 8px; text-align: left; vertical-align: top; }
        th { background: #005C3B; color: #ffffff; font-weight: bold; font-size: 11px; text-transform: uppercase; letter-spacing: 0.02em; }
        td.num, th.num { text-align: center; width: 32px; }
        td.time, th.time { white-space: nowrap; width: 110px; }
        .striped tr:nth-child(even) { background: #FAFAFA; }
        .empty { padding: 40px; text-align: center; color: #9CA3AF; }
        .meta { margin-top: 12px; font-size: 11px; color: #4B5563; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>Data Leads</h1>
            <p>DUYUFUNA Travel Umroh &amp; Haji</p>
        </div>
        <p>Diekspor pada: {{ $exportedAt }}</p>
    </div>

    @if($customers->isEmpty())
    <div class="empty">Tidak ada data lead untuk diexport.</div>
    @else
    <table class="striped">
        <thead>
            <tr>
                <th class="num">No</th>
                <th>Nama</th>
                <th>No WhatsApp</th>
                <th>Sumber</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Tanggal Rekam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $i => $c)
            <tr>
                <td class="num">{{ $i + 1 }}</td>
                <td>{{ $c->nama }}</td>
                <td>{{ $c->no_hp }}</td>
                <td>{{ $c->sumber ?? '-' }}</td>
                <td>{{ $c->alamat ?? '-' }}</td>
                <td>{{ \App\Models\Customer::STATUSES[$c->status] ?? ucfirst((string) $c->status) }}</td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="meta">Total: <strong>{{ $customers->count() }}</strong> lead &nbsp;·&nbsp; Sumber: Data Leads</div>
</body>
</html>