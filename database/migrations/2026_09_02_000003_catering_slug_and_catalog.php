<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah kategori Catering: slug "catering-bandara" -> "catering",
     * aktifkan mode catalog agar halaman kategori & tombol "Lihat Detail"
     * menampilkan item (paket menu) dengan benar.
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'catering-bandara')
            ->update([
                'slug' => 'catering',
                'page_type' => 'catalog',
                'is_catalog' => true,
                'group_label' => 'Jenis',
                'item_label' => 'Paket',
            ]);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'catering')
            ->update([
                'slug' => 'catering-bandara',
                'page_type' => 'cards',
                'is_catalog' => false,
                'group_label' => null,
                'item_label' => null,
            ]);
    }
};
