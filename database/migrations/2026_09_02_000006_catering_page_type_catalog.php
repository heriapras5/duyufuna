<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Pulihkan kategori Catering menjadi mode catalog (Grup -> Produk)
     * agar halaman kategori menampilkan grup (Kedatangan/Kepulangan)
     * dan halaman service menampilkan item (paket menu) sebagai katalog produk.
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'catering')
            ->update([
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
                'page_type' => 'cards',
                'group_label' => null,
                'item_label' => null,
            ]);
    }
};
