<?php

namespace Database\Seeders;

use App\Models\TransportPrice;
use App\Models\TransportRoute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportPriceSeeder extends Seeder
{
    // Sumber data: transportasi.jpg (tabel harga MAAD, 11 destinasi x 9 kendaraan, SAR).
    // Nilai di bawah adalah harga final (termasuk kenaikan tarif 60 SAR per rute).
    protected array $routes = [
        ['code' => '01', 'name_ar' => 'مطار جدة إلى جدة', 'pickup' => 'Bandara Jeddah', 'dropoff' => 'Jeddah'],
        ['code' => '02', 'name_ar' => 'مطار جدة إلى مكة', 'pickup' => 'Bandara Jeddah', 'dropoff' => 'Makkah'],
        ['code' => '03', 'name_ar' => 'مطار المدينة إلى فندق المدينة', 'pickup' => 'Bandara Madinah', 'dropoff' => 'Hotel Madinah'],
        ['code' => '04', 'name_ar' => 'جدة أو مكة إلى المدينة', 'pickup' => 'Jeddah / Makkah', 'dropoff' => 'Madinah'],
        ['code' => '05', 'name_ar' => 'قطار الحرمين أو مكة إلى المدينة', 'pickup' => 'Stasiun Haramain', 'dropoff' => 'Madinah'],
        ['code' => '06', 'name_ar' => 'زيارة مكة أو المدينة (4 ساعات)', 'pickup' => 'Makkah / Madinah', 'dropoff' => 'Ziarah (4 Jam)'],
        ['code' => '07', 'name_ar' => 'جولة الطائف (6 ساعات)', 'pickup' => 'Makkah', 'dropoff' => 'Tur Taif (6 Jam)'],
        ['code' => '08', 'name_ar' => 'جولة جدة (6 ساعات)', 'pickup' => 'Jeddah', 'dropoff' => 'Tur Jeddah (6 Jam)'],
        ['code' => '09', 'name_ar' => 'جولة العلا (6 ساعات)', 'pickup' => 'Madinah', 'dropoff' => 'Tur AlUla (6 Jam)'],
        ['code' => '10', 'name_ar' => 'دورة كاملة: مطار جدة ← مكة والمدينة (مع الزيارة) ← مطار جدة', 'pickup' => 'Bandara Jeddah', 'dropoff' => 'Paket Lengkap A (Ziarah)'],
        ['code' => '11', 'name_ar' => 'دورة كاملة: مطار جدة ← مكة ← المدينة (مع الزيارة) ← مطار جدة', 'pickup' => 'Bandara Jeddah', 'dropoff' => 'Paket Lengkap B (Ziarah)'],
    ];

    protected array $vehicles = ['Camry', 'Ford', 'Lexus', 'Traverse', 'GMC', 'Staria', 'Hiace', 'Coaster', 'Bus'];

    // price[route_index][vehicle_index] = SAR (harga final)
    protected array $prices = [
        /* 01 Jeddah Airport → Jeddah      Camry Ford Lexus Trav  GMC Staria Hiace Coaster Bus */
        [210, 260, 310, 310, 360, 360, 360, 510, 710],
        /* 02 Jeddah Airport → Makkah */
        [310, 360, 410, 410, 460, 410, 460, 560, 860],
        /* 03 Madinah Airport → Madinah Hotel */
        [260, 260, 310, 310, 410, 360, 410, 510, 710],
        /* 04 Jeddah or Makkah → Madinah */
        [660, 710, 810, 810, 1010, 810, 910, 1060, 1160],
        /* 05 Haramain Train Station → Madinah */
        [210, 260, 310, 310, 410, 360, 410, 460, 510],
        /* 06 Ziyarat Makkah/Madinah (4 hours) */
        [360, 410, 410, 410, 460, 460, 510, 560, 560],
        /* 07 Taif Tour (6 hours) */
        [660, 710, 810, 810, 960, 860, 960, 1060, 1260],
        /* 08 Jeddah Tour (6 hours) */
        [660, 710, 810, 810, 960, 860, 960, 1060, 1160],
        /* 09 AlUla Tour (6 hours) */
        [1260, 1360, 1460, 1460, 1710, 1610, 1710, 1860, 2060],
        /* 10 Full package: Jeddah Airport → Makkah & Madinah (with Ziyarat) → Jeddah Airport */
        [1960, 2060, 2360, 2410, 2660, 2360, 2610, 2860, 2660],
        /* 11 Full package (alternate route order) */
        [1560, 1660, 1960, 1910, 2360, 2060, 2310, 2660, 2660],
    ];

    public function run(): void
    {
        // Truncate existing (prices first due to FK, disable FK checks)
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('transport_prices')->truncate();
        DB::table('transport_routes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        foreach ($this->routes as $i => $r) {
            $route = TransportRoute::create([
                'code' => $r['code'],
                'name_ar' => $r['name_ar'],
                'pickup_label' => $r['pickup'],
                'dropoff_label' => $r['dropoff'],
                'sort' => $i + 1,
            ]);

            foreach ($this->vehicles as $j => $vehicle) {
                $price = $this->prices[$i][$j] ?? null;
                TransportPrice::create([
                    'route_id' => $route->id,
                    'vehicle' => $vehicle,
                    'price' => $price,
                ]);
            }
        }
    }
}
