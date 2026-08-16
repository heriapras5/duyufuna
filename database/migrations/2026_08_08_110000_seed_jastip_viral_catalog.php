<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $categoryId = DB::table('categories')->where('slug', 'jastip-viral')->value('id');
        if (!$categoryId) {
            return;
        }

        $alreadySeeded = DB::table('services')->where('category_id', $categoryId)->exists();
        if ($alreadySeeded) {
            return;
        }

        $groups = [
            ['kurma-makanan-khas', 'Kurma & Makanan Khas', 'Beragam kurma premium, madu, dan makanan khas dari Mekkah, Madinah, dan Jeddah.'],
            ['parfum-minyak-wangi', 'Parfum & Minyak Wangi', 'Parfum Arab, oud, attar, dan minyak wangi halal yang sedang viral di Tanah Suci.'],
            ['oleh-oleh-souvenir', 'Oleh-Oleh & Souvenir', 'Tasbih, kaligrafi, dan souvenir khas Ka\'bah untuk buah tangan keluarga.'],
            ['perlengkapan-ibadah', 'Perlengkapan Ibadah', 'Mukena, sarung, sajadah, dan perlengkapan ibadah berkualitas untuk jamaah.'],
        ];

        $groupIds = [];
        foreach ($groups as $g) {
            $groupIds[$g[1]] = DB::table('services')->insertGetId([
                'category_id'       => $categoryId,
                'title'             => $g[1],
                'slug'              => $g[0],
                'short_description' => $g[2],
                'description'       => '<p>' . $g[2] . '</p>',
                'status'            => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        $items = [
            'Kurma & Makanan Khas' => [
                'Kurma Ajwa',
                'Kurma Sukari',
                'Kurma Medjool',
                'Sari Kurma (Date Syrup)',
                'Madu Arab Asli',
                'Snack & Kue Khas Arab Saudi',
            ],
            'Parfum & Minyak Wangi' => [
                'Parfum Arab (Oud)',
                'Oud & Bukhoor',
                'Minyak Wangi Attar',
                'Parfum Thar & Micro',
                'Minyak Wangi Musk',
                'Oud / Kayu Bakar',
            ],
            'Oleh-Oleh & Souvenir' => [
                'Tasbih Unik',
                'Kaligrafi & Velvet',
                'Peci / Songkok Arab',
                'Gantungan Kunci Ka\'bah',
                'Lukisan Hiasan Islami',
                'Misk & Jubah Prayer',
            ],
            'Perlengkapan Ibadah' => [
                'Mukena Premium',
                'Sarung Arab',
                'Sajadah Anti-Slip',
                'Al-Qur\'an Mini & Buku Doa',
                'Peci / Songkok Hitam',
                'Prayer Mat Khusus',
            ],
        ];

        foreach ($items as $groupId => $productList) {
            $svcId = $groupIds[$groupId] ?? null;
            if (!$svcId) {
                continue;
            }
            $sort = 1;
            foreach ($productList as $title) {
                DB::table('service_items')->insert([
                    'service_id'  => $svcId,
                    'title'       => $title,
                    'description' => '<p>' . $title . ' tersedia melalui layanan Jastip Viral DUYUFUNA. Silakan konsultasikan permintaan, stok, dan ketentuan pengiriman dengan tim kami.</p>',
                    'sort'        => $sort,
                    'status'      => true,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
                $sort++;
            }
        }
    }

    public function down(): void
    {
        $categoryId = DB::table('categories')->where('slug', 'jastip-viral')->value('id');
        if (!$categoryId) {
            return;
        }
        $serviceIds = DB::table('services')->where('category_id', $categoryId)->pluck('id');
        DB::table('service_items')->whereIn('service_id', $serviceIds)->delete();
        DB::table('services')->where('category_id', $categoryId)->delete();
    }
};