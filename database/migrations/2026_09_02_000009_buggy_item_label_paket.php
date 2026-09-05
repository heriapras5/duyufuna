<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'buggy-car')
            ->update(['item_label' => 'Paket Buggy Car']);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'buggy-car')
            ->update(['item_label' => 'Layanan Buggy']);
    }
};
