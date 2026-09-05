<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Konsolidasi kategori Handling untuk DB lama yang masih punya
     * handling-bandara + handling-hotel (dua kategori terpisah):
     * gabungkan menjadi satu kategori `handling` (catalog) dengan
     * service "Handling Umroh" + paket SILVER/GOLD/PLATINUM.
     * Idempotent: skip jika kategori `handling` sudah ada.
     */
    public function up(): void
    {
        // Sudah dikonsolidasi? skip.
        if (DB::table('categories')->where('slug', 'handling')->exists()) {
            return;
        }

        // Pilih kategori lama sebagai basis (handling-bandara prioritas).
        $oldCategory = DB::table('categories')
            ->whereIn('slug', ['handling-bandara', 'handling-hotel'])
            ->orderByRaw("CASE WHEN slug = 'handling-bandara' THEN 0 ELSE 1 END")
            ->orderBy('id')
            ->first();

        if (! $oldCategory) {
            // DB sudah bersih tapi kategori handling belum ada — buat baru.
            $catId = (int) DB::table('categories')->insertGetId($this->categoryRow());
            $this->createHandlingService($catId);
            return;
        }

        $keepId = (int) $oldCategory->id;
        $removeIds = DB::table('categories')
            ->whereIn('slug', ['handling-bandara', 'handling-hotel'])
            ->where('id', '!=', $keepId)
            ->pluck('id')
            ->all();

        // 1. Hapus service lama dari kedua kategori (+ item & gambar)
        $allCatIds = array_merge([$keepId], $removeIds);
        $oldServiceIds = DB::table('services')
            ->whereIn('category_id', $allCatIds)
            ->pluck('id')
            ->all();

        foreach ($oldServiceIds as $sid) {
            $images = DB::table('service_items')->where('service_id', $sid)->pluck('image');
            foreach ($images as $img) {
                if ($img) {
                    try {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($img);
                    } catch (\Exception $e) {
                    }
                }
            }
            DB::table('service_items')->where('service_id', $sid)->delete();
            Service::where('id', $sid)->delete();
        }

        // 2. Hapus kategori duplikat
        if ($removeIds !== []) {
            DB::table('categories')->whereIn('id', $removeIds)->delete();
        }

        // 3. Jadikan kategori yang tersisa = Handling (catalog)
        DB::table('categories')->where('id', $keepId)->update($this->categoryRow());

        // 4. Service Handling Umroh + 3 paket
        $this->createHandlingService($keepId);
    }

    protected function categoryRow(): array
    {
        return [
            'slug' => 'handling',
            'name' => 'Handling',
            'icon' => '🛎️',
            'page_type' => 'catalog',
            'is_catalog' => true,
            'group_label' => 'Layanan',
            'item_label' => 'Paket',
            'subtitle' => 'Layanan profesional sejak mendarat',
            'description' => 'Layanan handling bandara kedatangan & kepulangan serta handling hotel check-in & check-out yang profesional dengan pilihan paket Silver, Gold, dan Platinum.',
            'meta_title' => 'Handling Umroh',
            'meta_description' => 'Layanan handling bandara dan hotel untuk jamaah umroh.',
            'meta_keywords' => 'handling umroh, handling bandara, handling hotel',
            'sort' => 4,
        ];
    }

    protected function createHandlingService(int $catId): void
    {
        $service = Service::create([
            'category_id' => $catId,
            'title' => 'Handling Umroh',
            'slug' => 'handling-umroh',
            'short_description' => 'HANDLING ONLY · Duration 9 Days',
            'duration' => '9 Hari',
            'icon' => '🛎️',
            'status' => true,
        ]);

        $packages = [
            'SILVER' => [
                'prices' => [
                    '35–47 Pax — $73.00/Pax',
                    '25–34 Pax — $78.00/Pax',
                    '16–24 Pax — $98.00/Pax',
                    '11–15 Pax — $173.00/Pax',
                ],
                'pax_prices' => [
                    ['min' => 35, 'max' => 47, 'price' => 73],
                    ['min' => 25, 'max' => 34, 'price' => 78],
                    ['min' => 16, 'max' => 24, 'price' => 98],
                    ['min' => 11, 'max' => 15, 'price' => 173],
                ],
                'includes' => [
                    'Handling Bandara Kedatangan & Kepulangan',
                    'Tipping Bandara',
                    'Meal Box Kedatangan & Kepulangan',
                    'Check In & Check Out Hotel Mekkah & Madinah',
                    'Team Distribusi Koper depan kamar Jamaah',
                    'Snack City Tour Mekkah, Madinah & Thaif',
                    'Welcome Drink hotel kedatangan pertama',
                    'Air Zam-Zam 5 Liter',
                    'Muthawwifah Raudhah',
                ],
            ],
            'GOLD' => [
                'prices' => [
                    '35–47 Pax — $80.00/Pax',
                    '25–34 Pax — $85.00/Pax',
                    '16–24 Pax — $105.00/Pax',
                    '11–15 Pax — $181.00/Pax',
                ],
                'pax_prices' => [
                    ['min' => 35, 'max' => 47, 'price' => 80],
                    ['min' => 25, 'max' => 34, 'price' => 85],
                    ['min' => 16, 'max' => 24, 'price' => 105],
                    ['min' => 11, 'max' => 15, 'price' => 181],
                ],
                'includes' => [
                    'Handling Bandara Kedatangan & Kepulangan',
                    'Tipping Bandara',
                    'Meal Box Kedatangan & Kepulangan',
                    'Check In & Check Out Hotel Mekkah & Madinah',
                    'Team Distribusi Koper depan kamar Jamaah',
                    'Snack City Tour Mekkah, Madinah & Thaif',
                    'Welcome Drink hotel kedatangan pertama',
                    'Air Zam-Zam 5 Liter & Al Baik',
                    'Muthawwifah Raudhah',
                ],
            ],
            'PLATINUM' => [
                'prices' => [
                    '35–47 Pax — $93.00/Pax',
                    '25–34 Pax — $108.00/Pax',
                    '16–24 Pax — $123.00/Pax',
                    '4–15 Pax — $193.00/Pax',
                ],
                'pax_prices' => [
                    ['min' => 35, 'max' => 47, 'price' => 93],
                    ['min' => 25, 'max' => 34, 'price' => 108],
                    ['min' => 16, 'max' => 24, 'price' => 123],
                    ['min' => 4, 'max' => 15, 'price' => 193],
                ],
                'includes' => [
                    'Handling Bandara Kedatangan & Kepulangan',
                    'Tipping Bandara',
                    'Meal Box Kedatangan & Kepulangan',
                    'Check In & Check Out Hotel Mekkah & Madinah',
                    'Team Distribusi Koper depan kamar Jamaah',
                    'Snack City Tour Mekkah, Madinah & Thaif',
                    'Welcome Drink hotel kedatangan pertama',
                    'Air Zam-Zam 5 Liter & Al Baik',
                    'Muthawwifah Raudhah',
                    'Welcome Food di kamar Jamaah (Air Zam-Zam 5 L, Kurma, Buah)',
                ],
            ],
        ];

        $sort = 1;
        foreach ($packages as $title => $pkg) {
            $priceHtml = '';
            foreach ($pkg['prices'] as $p) {
                $priceHtml .= '<li>' . e($p) . '</li>';
            }

            $service->serviceItems()->create([
                'title' => $title,
                'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5">' . $priceHtml . '</ul>',
                'benefit' => implode("\n", $pkg['includes']),
                'pax_prices' => $pkg['pax_prices'],
                'sort' => $sort,
                'status' => true,
            ]);
            $sort++;
        }
    }

    public function down(): void
    {
        // Tidak dibalikkan — konsolidasi ini memperbaiki data.
    }
};
