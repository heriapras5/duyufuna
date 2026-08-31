@props([
    'label' => 'Mode Tampilan Halaman Publik',
    'help' => 'Menentukan cara halaman kategori ini tampil di website publik.',
    'model' => 'pageType',
    'name' => 'page_type',
])

@php
    $modes = [
        'cards' => [
            'title' => 'Kartu Layanan',
            'desc' => 'Grid kartu layanan bergambar. Klik kartu membuka halaman detail layanan.',
            'example' => 'Contoh: Handling Bandara, Handling Hotel',
            'sketch' => 'grid',
        ],
        'transport' => [
            'title' => 'Kartu Detail & Konsultasi',
            'desc' => 'Kartu dengan tombol Detail (popup) dan Konsultasi (WhatsApp), tanpa pindah halaman. Teks deskripsi tampil di atas.',
            'example' => 'Contoh: Transportasi',
            'sketch' => 'modal',
        ],
        'catalog' => [
            'title' => 'Katalog Grup & Item',
            'desc' => 'Pengunjung memilih grup dulu (mis. Kota), lalu item (mis. Nama Hotel).',
            'example' => 'Contoh: Hotel, Visa, Jastip Viral',
            'sketch' => 'list',
        ],
        'form' => [
            'title' => 'Form Konsultasi',
            'desc' => 'Halaman langsung menampilkan form nama & nomor WhatsApp, tanpa kartu layanan.',
            'example' => 'Contoh: Laundry, Buggy Car, Kursi Roda, Fotografer, Penukaran Uang, Muthawif',
            'sketch' => 'form',
        ],
    ];
@endphp

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}</label>
    @if($help)
    <p class="text-xs text-gray-400 mb-3">{{ $help }}</p>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        @foreach($modes as $value => $mode)
        <label class="relative block cursor-pointer rounded-xl border-2 p-4 transition-all duration-200 select-none"
               :class="{{ $model }} === '{{ $value }}' ? 'border-emerald-500 bg-emerald-50/60 shadow-sm' : 'border-gray-200 bg-white hover:border-emerald-300'">
            <input type="radio" name="{{ $name }}" value="{{ $value }}" class="sr-only" x-model="{{ $model }}">
            <div class="flex items-start gap-3">
                <div class="w-16 h-14 shrink-0 rounded-lg border border-gray-100 bg-gray-50/60 p-2 flex items-center justify-center">
                    @if($mode['sketch'] === 'grid')
                    <div class="flex gap-1">
                        @for($i = 0; $i < 3; $i++)
                        <div class="w-5 h-8 rounded-sm bg-emerald-100 ring-1 ring-emerald-200/70"></div>
                        @endfor
                    </div>
                    @elseif($mode['sketch'] === 'modal')
                    <div class="w-12">
                        <div class="h-5 rounded-sm bg-emerald-100 ring-1 ring-emerald-200/70 mb-1"></div>
                        <div class="flex gap-1">
                            <div class="h-2.5 flex-1 rounded-full bg-emerald-200/80"></div>
                            <div class="h-2.5 flex-1 rounded-full bg-emerald-400/80"></div>
                        </div>
                    </div>
                    @elseif($mode['sketch'] === 'list')
                    <div class="w-12 space-y-1">
                        <div class="h-2.5 rounded-sm bg-emerald-200/80"></div>
                        <div class="h-2.5 ml-2 rounded-sm bg-emerald-100 ring-1 ring-emerald-200/60"></div>
                        <div class="h-2.5 ml-2 rounded-sm bg-emerald-100 ring-1 ring-emerald-200/60"></div>
                    </div>
                    @else
                    <div class="w-12 space-y-1">
                        <div class="h-2.5 rounded-sm bg-gray-100 ring-1 ring-gray-200/80"></div>
                        <div class="h-2.5 rounded-sm bg-gray-100 ring-1 ring-gray-200/80"></div>
                        <div class="h-2.5 w-8 rounded-full bg-emerald-400/90"></div>
                    </div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-2">
                        <h4 class="text-sm font-semibold text-gray-900 leading-snug">{{ $mode['title'] }}</h4>
                        <span class="w-4 h-4 rounded-full border-2 shrink-0 transition-colors duration-200"
                              :class="{{ $model }} === '{{ $value }}' ? 'border-emerald-500 bg-emerald-500' : 'border-gray-300 bg-white'"></span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $mode['desc'] }}</p>
                    <p class="text-[11px] font-medium text-emerald-600 mt-1.5">{{ $mode['example'] }}</p>
                </div>
            </div>
        </label>
        @endforeach
    </div>

    <p class="text-[11px] text-gray-400 mt-2">Bisa diubah kapan saja — data layanan yang sudah ada tidak akan hilang.</p>
</div>
