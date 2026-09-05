<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('categories')
            ->whereIn('slug', ['hotel', 'laundry', 'buggy-car', 'kursi-roda-umroh'])
            ->update(['subtitle' => null]);
    }

    public function down(): void
    {
        // Subtitle dikosongkan permanen sesuai permintaan; tidak ada rollback data.
    }
};
