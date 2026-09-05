<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Kenaikan tarif transportasi: +60 SAR (sumber: transportasi.jpg, 11 rute x 9 kendaraan).
    public function up(): void
    {
        DB::table('transport_prices')->whereNotNull('price')->increment('price', 60);

        DB::statement(
            'UPDATE services SET price_sar = price_sar + 60 WHERE category_id IN (SELECT id FROM categories WHERE page_type = ?)',
            ['transport']
        );
    }

    public function down(): void
    {
        DB::table('transport_prices')->whereNotNull('price')->where('price', '>=', 60)->decrement('price', 60);

        DB::statement(
            'UPDATE services SET price_sar = price_sar - 60 WHERE price_sar IS NOT NULL AND price_sar >= 60 AND category_id IN (SELECT id FROM categories WHERE page_type = ?)',
            ['transport']
        );
    }
};
