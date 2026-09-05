<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Normalisasi kategori Catering: page_type kembali ke "cards" agar
     * halaman kategori memakai layout kartu khusus (show_catering).
     * is_catalog tetap true agar halaman service menampilkan item menu.
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'catering')
            ->update([
                'page_type' => 'cards',
                'group_label' => null,
                'item_label' => null,
            ]);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'catering')
            ->update([
                'page_type' => 'catalog',
                'group_label' => 'Jenis',
                'item_label' => 'Paket',
            ]);
    }
};
