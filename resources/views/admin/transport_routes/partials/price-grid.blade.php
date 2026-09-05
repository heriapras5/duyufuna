@props([
    'vehicles' => [],
    'priceMap' => [],
])

<div class="mt-5 pt-5 border-t border-gray-100">
    <div class="flex items-center justify-between mb-1">
        <h3 class="text-sm font-bold text-gray-900">Tarif per Kendaraan (SAR)</h3>
        <span class="text-[11px] text-gray-400">Kosongkan jika armada tidak melayani rute ini</span>
    </div>
    <p class="text-xs text-gray-400 mb-4">Harga dalam Riyal Saudi (SAR) per kendaraan. Isi hanya armada yang tersedia untuk rute ini.</p>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        @forelse($vehicles as $vehicle)
        <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-3">
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">{{ $vehicle }}</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[10px] font-bold text-gray-400 uppercase tracking-wide">SAR</span>
                <input type="number" name="prices[{{ $vehicle }}]" step="0.01" min="0" inputmode="decimal"
                       value="{{ old('prices.' . $vehicle, isset($priceMap[$vehicle]) && $priceMap[$vehicle] !== null ? $priceMap[$vehicle] : '') }}"
                       placeholder="—"
                       class="w-full pl-11 pr-3 py-2.5 rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 placeholder-gray-300 tabular-nums focus:ring-2 focus:ring-gold/40 focus:border-gold outline-none transition">
            </div>
        </div>
        @empty
        <p class="text-xs text-gray-400 col-span-full">Tidak ada armada aktif. Tambahkan layanan kendaraan pada kategori transportasi terlebih dahulu.</p>
        @endforelse
    </div>
</div>