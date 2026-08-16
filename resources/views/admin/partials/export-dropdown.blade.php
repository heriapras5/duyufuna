@props([
    'excelRoute' => '',
    'pdfRoute' => '',
])
<div class="flex items-center gap-2">
    <a href="{{ $excelRoute }}" title="Export Excel" class="btn btn-green min-w-[110px] justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M8 15h6"/><path d="M8 18h6"/><path d="M8 12h2"/></svg>
        Excel
    </a>
    <a href="{{ $pdfRoute }}" target="_blank" rel="noopener" title="Export PDF" class="btn btn-danger min-w-[110px] justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 15h6"/><path d="M9 18h6"/><path d="M9 12h2"/></svg>
        PDF
    </a>
</div>
