<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah nama menu kategori Handling dari "Handling Bandara dan Hotel"
     * menjadi "Handling" sesuai permintaan user.
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'handling-bandara-hotel')
            ->update(['name' => 'Handling']);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'handling-bandara-hotel')
            ->update(['name' => 'Handling Bandara dan Hotel']);
    }
};
