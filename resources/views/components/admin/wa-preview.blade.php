@props([
    'name' => 'wa_message',
    'sample' => [],
    'number' => null,
    'withIdentity' => true,
    'titleSource' => null,
    'titlePrefix' => null,
])

@php
    $identity = [
        'nama' => '',
        'no_hp' => '',
        'kategori' => $withIdentity ? 'Umroh' : '',
        'layanan' => $withIdentity ? 'Paket Umroh Reguler' : '',
        'item' => $withIdentity ? 'Paket Umroh Reguler' : '',
    ];
    $sampleData = array_merge($identity, [
        'website' => $globalSetting?->website_name ?: config('app.name'),
        'tanggal' => now()->format('d-m-Y H:i'),
    ], $sample);
    $targetNumber = $number ?: ($globalSetting?->whatsapp ?: '6281293679502');
    $waName = $globalSetting?->website_name ?: 'DUYUFUNA';
@endphp

<div class="wa-preview mt-3" data-input="{{ $name }}" data-sample='@json($sampleData)' @if($titleSource) data-title-source="{{ $titleSource }}" @endif @if($titlePrefix) data-title-prefix="{{ $titlePrefix }}" @endif>
    <label class="block text-xs font-medium text-gray-500 mb-1.5">Pratinjau Pesan WhatsApp</label>

    <div class="mx-auto w-full max-w-sm rounded-[2rem] border-[10px] border-gray-900 bg-gray-900 shadow-xl overflow-hidden select-none">
        {{-- Header chat --}}
        <div class="flex items-center gap-3 bg-dark-green px-3 py-2.5 text-white">
            <div class="min-w-0 flex-1 leading-tight">
                <p class="text-sm font-semibold truncate">{{ $waName }}</p>
                <p class="text-[10px] text-emerald-100/80 font-mono">{{ $targetNumber }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#ffffff" class="opacity-80 shrink-0"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
        </div>

        {{-- Area chat --}}
        <div class="relative h-64 overflow-y-auto px-3 py-3 bg-[#ECE5DD]" style="background-image:radial-gradient(rgba(0,0,0,0.05) 1px, transparent 1px);background-size:14px 14px;">
            <div class="flex justify-end">
                <div class="max-w-[85%] bg-[#DCF8C6] rounded-2xl rounded-tr-sm px-3 py-2 shadow-sm">
                    <p class="text-[13px] text-gray-800 whitespace-pre-wrap leading-relaxed wa-preview-text">Mengetik untuk memuat pratinjau…</p>
                    <span class="block text-right text-[10px] text-gray-500 mt-1 leading-none">{{ now()->format('H:i') }} <span class="text-blue-500">✓✓</span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2 flex items-center justify-between gap-2">
        <p class="text-[11px] text-gray-400">Dikirim ke: <span class="font-mono font-medium text-gray-600">{{ $targetNumber }}</span></p>
        <button type="button" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium wa-preview-refresh shrink-0">Muat Ulang</button>
    </div>
    @if(!$withIdentity)
    <p class="text-[11px] text-gray-400 mt-1.5 leading-relaxed">Pesan dikirim apa adanya — Konsultasi (menu bawah) tidak mengisi nama/nomor pengunjung.</p>
    @else
    <p class="text-[11px] text-gray-400 mt-1.5 leading-relaxed">Nama & nomor WhatsApp sengaja dikosongkan pada pratinjau — akan terisi otomatis dari data pengunjung saat dikirim.</p>
    @endif
</div>

@once
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.wa-preview').forEach(function (box) {
        var input = document.getElementById(box.dataset.input);
        if (!input) return;
        var text = box.querySelector('.wa-preview-text');
        var route = @json(route('admin.whatsapp.preview'));
        var token = @json(csrf_token());
        var sample = JSON.parse(box.dataset.sample || '{}');
        var titleInput = box.dataset.titleSource ? document.getElementById(box.dataset.titleSource) : null;
        var prefix = (box.dataset.titlePrefix || '').trim();
        var run = function () {
            var data = sample;
            if (titleInput && titleInput.value.trim() !== '') {
                data = Object.assign({}, sample, { item: (prefix ? prefix + ' ' : '') + titleInput.value.trim() });
            }
            fetch(route, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ template: input.value, data: data }),
            })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                text.textContent = (res && res.preview) ? res.preview : '(kosong)';
            })
            .catch(function () { text.textContent = 'Gagal memuat pratinjau.'; });
        };
        input.addEventListener('input', run);
        if (titleInput) titleInput.addEventListener('input', run);
        if (box.querySelector('.wa-preview-refresh')) {
            box.querySelector('.wa-preview-refresh').addEventListener('click', run);
        }
        run();
    });
});
</script>
@endpush
@endonce