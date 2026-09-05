<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Hapus kategori Catering duplikat (slug "catering", ID lama) yang
     * memiliki data lebih sedikit. Kategori resmi adalah "catering-bandara".
     * Services & items terhapus otomatis via onDelete cascade.
     */
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'catering')
            ->where('name', 'Catering')
            ->delete();
    }

    public function down(): void
    {
        // Tidak mengembalikan kategori yang sudah dihapus beserta datanya.
    }
};
