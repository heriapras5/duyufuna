@php
    $iconUrl = ($globalSetting && $globalSetting->favicon)
        ? Storage::url($globalSetting->favicon)
        : (($globalSetting && $globalSetting->logo) ? Storage::url($globalSetting->logo) : asset('favicon.ico'));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview Export - Leads</title>
    <link rel="icon" href="{{ $iconUrl }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        body { font-family: 'Inter', 'Poppins', ui-sans-serif, system-ui, sans-serif; background: #f3f4f6; }
        .bar {
            display: flex; align-items: center; justify-content: space-between;
            height: 48px; padding: 0 16px; background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
        .bar .brand { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #111827; }
        .bar img { height: 24px; width: auto; }
        .bar span { color: #6b7280; font-size: 12px; }
        iframe { display: block; width: 100%; height: calc(100% - 48px); border: 0; background: #ffffff; }
    </style>
</head>
<body>
    <div class="bar">
        <div class="brand">
            @if($globalSetting && $globalSetting->logo)
            <img src="{{ Storage::url($globalSetting->logo) }}" alt="Logo">
            @endif
            <span>Preview Export Data Leads</span>
        </div>
        <span>{{ $customers->count() }} lead</span>
    </div>
    <iframe src="{{ route('admin.customers.export-pdf', array_merge(request()->query(), ['t' => time()])) }}" title="Preview PDF"></iframe>
</body>
</html>