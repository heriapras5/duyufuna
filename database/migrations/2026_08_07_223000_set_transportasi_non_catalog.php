<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Transportasi dikelola sebagai daftar layanan langsung (flat),
     * bukan katalog grup -> item, sehingga admin menampilkan
     * nama-nama jenis transportasi tanpa langkah "Kelola".
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'transportasi')
            ->update([
                'is_catalog' => false,
                'group_label' => null,
                'item_label' => null,
            ]);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'transportasi')
            ->update([
                'is_catalog' => true,
                'group_label' => 'Jenis Kendaraan',
                'item_label' => 'Kendaraan',
            ]);
    }
};
