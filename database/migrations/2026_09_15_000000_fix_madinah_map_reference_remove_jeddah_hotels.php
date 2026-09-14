<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Kategori Hotel: hapus Jeddah, fokus Mekkah & Madinah.
        DB::table('categories')->where('slug', 'hotel')->update([
            'description' => 'Pilihan hotel terbaik di Mekkah dan Madinah untuk kenyamanan ibadah Anda.',
            'meta_title' => 'Hotel Umroh Mekkah Madinah',
            'meta_description' => 'Pilih hotel terbaik di area Masjidil Haram dan Masjid Nabawi untuk perjalanan umroh Anda.',
            'meta_keywords' => 'hotel umroh, hotel mekkah, hotel madinah',
        ]);

        // 2. Nonaktifkan service hotel Jeddah bila masih ada (URL lama jadi 404).
        DB::table('services')
            ->where(function ($q) {
                $q->where('slug', 'like', '%jeddah%')
                    ->orWhere('title', 'like', '%jeddah%');
            })
            ->update(['status' => false]);

        // 3. Betulkan map_link manual hotel Madinah yang terlanjur ke Masjidil Haram.
        $madinahServiceIds = DB::table('services')
            ->where(function ($q) {
                $q->where('slug', 'like', '%madinah%')
                    ->orWhere('title', 'like', '%madinah%');
            })
            ->pluck('id');

        if ($madinahServiceIds->isNotEmpty()) {
            $items = DB::table('service_items')
                ->whereIn('service_id', $madinahServiceIds)
                ->whereNotNull('map_link')
                ->where('map_link', 'like', '%Haram%')
                ->get(['id', 'map_link']);

            foreach ($items as $item) {
                $fixed = str_ireplace(
                    ['Masjid al-Haram, Makkah', 'Masjidil Haram'],
                    ['Masjid Nabawi, Madinah', 'Masjid Nabawi'],
                    $item->map_link
                );

                // Pastikan origin menyebut Madinah, bukan Makkah.
                if (stripos($fixed, 'Madinah') === false) {
                    $fixed = preg_replace('/Makkah/i', 'Madinah', $fixed);
                }

                DB::table('service_items')->where('id', $item->id)->update(['map_link' => $fixed]);
            }
        }

        // 4. FAQ layanan: sesuaikan ke Mekkah & Madinah.
        DB::table('faqs')
            ->where('question', 'like', '%layanan yang disediakan Duyufuna%')
            ->where('answer', 'like', '%Mekkah, Madinah, dan Jeddah%')
            ->update([
                'answer' => DB::raw("REPLACE(answer, 'di Mekkah, Madinah, dan Jeddah', 'di Mekkah dan Madinah')"),
            ]);
    }

    public function down(): void
    {
        // Tidak dikembalikan — perbaikan data bersifat satu arah.
    }
};
