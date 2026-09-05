<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Mengisi data Laundry: 1 layanan + 2 paket (1-5 Kg SAR 15, 5-10 Kg SAR 13).
    public function up(): void
    {
        $cat = DB::table('categories')->where('slug', 'laundry')->first();
        if (! $cat) {
            return;
        }

        $existing = DB::table('services')->where('category_id', $cat->id)->first();
        if ($existing) {
            return;
        }

        $slug = 'laundry';
        if (DB::table('services')->where('slug', $slug)->exists()) {
            $slug = 'laundry-layanan';
        }

        $serviceId = DB::table('services')->insertGetId([
            'category_id' => $cat->id,
            'title' => 'Laundry',
            'slug' => $slug,
            'short_description' => 'Layanan laundry pakaian jamaah, bersih dan wangi tepat waktu.',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $packages = [
            ['title' => 'Paket 1', 'info' => '1-5 Kg', 'price' => 15],
            ['title' => 'Paket 2', 'info' => '5-10 Kg', 'price' => 13],
        ];

        foreach ($packages as $i => $p) {
            DB::table('service_items')->insert([
                'service_id' => $serviceId,
                'title' => $p['title'],
                'info' => $p['info'],
                'price_per_night' => $p['price'],
                'sort' => $i + 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        $cat = DB::table('categories')->where('slug', 'laundry')->first();
        if (! $cat) {
            return;
        }

        $serviceIds = DB::table('services')->where('category_id', $cat->id)->pluck('id');
        DB::table('service_items')->whereIn('service_id', $serviceIds)->delete();
        DB::table('services')->where('category_id', $cat->id)->delete();
    }
};
