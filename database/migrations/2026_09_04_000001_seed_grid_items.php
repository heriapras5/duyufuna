<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * 1. Isi harga SAR item catering (kedatangan/kepulangan).
     * 2. Buat service + item Jastip Viral (kategori kosong di DB lama).
     * Idempotent: hanya mengisi yang masih NULL / belum ada.
     */
    public function up(): void
    {
        // ===== 1. Harga item catering (SAR) =====
        $cateringPrices = [
            'Paket Nasi Ayam Kabsah' => 25,
            'Paket Nasi Kebuli' => 25,
            'Paket Nasi Mandhi' => 25,
            'Paket Snack Box' => 10,
        ];

        $cateringCatId = DB::table('categories')->where('slug', 'catering')->value('id');
        if ($cateringCatId) {
            foreach ($cateringPrices as $title => $price) {
                DB::table('service_items')
                    ->whereIn('service_id', DB::table('services')->where('category_id', $cateringCatId)->pluck('id'))
                    ->where('title', $title)
                    ->whereNull('price_per_night')
                    ->update(['price_per_night' => $price]);
            }
        }

        // ===== 2. Jastip Viral: service + item =====
        $jastipCatId = DB::table('categories')->where('slug', 'jastip-viral')->value('id');
        if (! $jastipCatId) {
            return;
        }

        if (Service::where('category_id', $jastipCatId)->exists()) {
            return; // sudah ada
        }

        $jastip = [
            [
                'title' => 'Tumbler Tanah Suci',
                'slug' => 'jastip-tumbler',
                'short_description' => 'Tumbler eksklusif oleh-oleh umroh',
                'icon' => '🥤',
                'items' => [
                    ['Tumbler 350ml', 85000, 'Botol minum eksklusif oleh-oleh Tanah Suci, ukuran pas dan desain khas.'],
                    ['Tumbler 750ml', 95000, 'Botol minum besar dengan desain unik, cocok untuk menemani perjalanan ibadah.'],
                    ['Tumbler Stainless', 105000, 'Tumbler tahan panas berbahan stainless steel, awet dan kekinian.'],
                ],
            ],
            [
                'title' => 'Parfum Timur Tengah',
                'slug' => 'jastip-parfum',
                'short_description' => 'Parfum khas Timur Tengah berkualitas',
                'icon' => '🧴',
                'items' => [
                    ['Parfum 50ml', 150000, 'Parfum khas Timur Tengah dengan aroma tahan lama, ukuran 50ml.'],
                    ['Parfum 100ml', 200000, 'Parfum premium Timur Tengah dalam kemasan 100ml dengan wangi elegan.'],
                    ['Attar', 120000, 'Attar minyak wangi murni tanpa alkohol, aroma pekat khas Timur Tengah.'],
                ],
            ],
            [
                'title' => 'Kurma Sukari',
                'slug' => 'jastip-kurma-sukari',
                'short_description' => 'Kurma Sukari premium asli Madinah',
                'icon' => '🌴',
                'items' => [
                    ['Kurma Sukari 1kg', 120000, 'Kurma Sukari premium asli Madinah, manis dan lembut dalam kemasan 1kg.'],
                    ['Kurma Sukari 3kg', 320000, 'Kurma Sukari pilihan untuk oleh-oleh keluarga, kemasan 3kg.'],
                    ['Kurma Sukari Premium', 180000, 'Kurma Sukari grade premium dengan ukuran besar dan kualitas terbaik.'],
                ],
            ],
            [
                'title' => 'Tasbih Kayu',
                'slug' => 'jastip-tasbih',
                'short_description' => 'Tasbih kayu unik dan ringan',
                'icon' => '📿',
                'items' => [
                    ['Tasbih Kayu', 45000, 'Tasbih kayu ringan dan unik, oleh-oleh khas Tanah Suci yang berkesan.'],
                    ['Tasbih Cemara', 55000, 'Tasbih berbahan cemara dengan tekstur halus dan aroma khas.'],
                    ['Tasbih Kuku', 65000, 'Tasbih kuku awet dengan butiran rapi, cocok untuk jamaah yang aktif berdzikir.'],
                ],
            ],
        ];

        foreach ($jastip as $svc) {
            $service = Service::create([
                'category_id' => $jastipCatId,
                'title' => $svc['title'],
                'slug' => $svc['slug'],
                'short_description' => $svc['short_description'],
                'icon' => $svc['icon'],
                'status' => true,
            ]);

            $sort = 1;
            foreach ($svc['items'] as [$title, $price, $desc]) {
                $service->serviceItems()->create([
                    'title' => $title,
                    'description' => '<p>' . e($desc) . '</p>',
                    'price_per_night' => $price, // Rupiah
                    'sort' => $sort,
                    'status' => true,
                ]);
                $sort++;
            }
        }
    }

    public function down(): void
    {
        $jastipCatId = DB::table('categories')->where('slug', 'jastip-viral')->value('id');
        if ($jastipCatId) {
            $ids = DB::table('services')->where('category_id', $jastipCatId)->where('slug', 'like', 'jastip-%')->pluck('id');
            DB::table('service_items')->whereIn('service_id', $ids)->delete();
            DB::table('services')->whereIn('id', $ids)->delete();
        }
    }
};
