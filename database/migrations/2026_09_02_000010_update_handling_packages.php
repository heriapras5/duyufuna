<?php

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Kategori: rename slug + jadi catalog
        $catId = DB::table('categories')->where('slug', 'handling-bandara-hotel')->value('id');
        if (! $catId) {
            return;
        }

        DB::table('categories')->where('id', $catId)->update([
            'slug' => 'handling',
            'page_type' => 'catalog',
            'is_catalog' => true,
            'group_label' => 'Layanan',
            'item_label' => 'Paket',
            'subtitle' => 'Layanan profesional sejak mendarat',
            'description' => 'Layanan handling bandara kedatangan & kepulangan serta handling hotel check-in & check-out yang profesional dengan pilihan paket Silver, Gold, dan Platinum.',
        ]);

        // 2. Hapus service lama + items
        $oldIds = DB::table('services')->where('category_id', $catId)->pluck('id');
        DB::table('service_items')->whereIn('service_id', $oldIds)->delete();
        DB::table('services')->whereIn('id', $oldIds)->delete();

        // 3. Service baru
        $service = Service::create([
            'category_id' => $catId,
            'title' => 'Handling Umroh',
            'slug' => 'handling-umroh',
            'short_description' => 'HANDLING ONLY · Duration 9 Days',
            'duration' => '9 Hari',
            'icon' => '🛎️',
            'status' => true,
        ]);

        // 4. Tiga paket
        $packages = [
            'SILVER' => [
                'prices' => [
                    '35–47 Pax — $73.00/Pax',
                    '25–34 Pax — $78.00/Pax',
                    '16–24 Pax — $98.00/Pax',
                    '11–15 Pax — $173.00/Pax',
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
                'sort' => $sort,
                'status' => true,
            ]);
            $sort++;
        }
    }

    public function down(): void
    {
        $catId = DB::table('categories')->where('slug', 'handling')->value('id');
        if (! $catId) {
            return;
        }

        DB::table('categories')->where('id', $catId)->update([
            'slug' => 'handling-bandara-hotel',
            'page_type' => 'cards',
            'is_catalog' => false,
            'group_label' => null,
            'item_label' => null,
            'subtitle' => 'Layanan profesional',
        ]);

        $newService = DB::table('services')->where('category_id', $catId)->where('slug', 'handling-umroh')->first();
        if ($newService) {
            DB::table('service_items')->where('service_id', $newService->id)->delete();
            DB::table('services')->where('id', $newService->id)->delete();
        }
    }
};