<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Aktifkan mode katalog untuk kategori Visa agar bisa dikelola
     * lewat UI admin catalog (kelompok + item) seperti kategori Hotel.
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'visa')
            ->update([
                'is_catalog' => true,
                'group_label' => 'Jenis',
                'item_label' => 'Visa',
            ]);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'visa')
            ->update([
                'is_catalog' => false,
                'group_label' => null,
                'item_label' => null,
            ]);
    }
};