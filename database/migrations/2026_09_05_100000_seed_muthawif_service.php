<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Mengisi data awal kategori Muthawif: 1 layanan + 4 muthawif (nama, SAR 300).
    public function up(): void
    {
        $cat = DB::table('categories')->where('slug', 'muthawif')->first();
        if (! $cat) {
            return;
        }

        DB::table('categories')->where('id', $cat->id)->update(['item_label' => 'Muthawif']);

        $existing = DB::table('services')->where('category_id', $cat->id)->first();
        if ($existing) {
            return;
        }

        $slug = 'muthawif';
        if (DB::table('services')->where('slug', $slug)->exists()) {
            $slug = 'muthawif-layanan';
        }

        $serviceId = DB::table('services')->insertGetId([
            'category_id' => $cat->id,
            'title' => 'Muthawif',
            'slug' => $slug,
            'short_description' => 'Muthawif berpengalaman sebagai pembimbing ibadah selama di Tanah Suci.',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $names = ['Mohammad Jadid', 'A. Najian Muzaki', 'Asep Saepuloh', 'Faqih Nur Fahmi'];
        foreach ($names as $i => $name) {
            DB::table('service_items')->insert([
                'service_id' => $serviceId,
                'title' => $name,
                'info' => 'Muthawif Harian, Mingguan & Bulanan',
                'price_per_night' => 300,
                'sort' => $i + 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        $cat = DB::table('categories')->where('slug', 'muthawif')->first();
        if (! $cat) {
            return;
        }

        $serviceIds = DB::table('services')->where('category_id', $cat->id)->pluck('id');
        DB::table('service_items')->whereIn('service_id', $serviceIds)->delete();
        DB::table('services')->where('category_id', $cat->id)->delete();
        DB::table('categories')->where('id', $cat->id)->update(['item_label' => null]);
    }
};
