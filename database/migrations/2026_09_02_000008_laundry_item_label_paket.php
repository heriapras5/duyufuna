<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('categories')
            ->where('slug', 'laundry')
            ->update(['item_label' => 'Paket Laundry']);
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'laundry')
            ->update(['item_label' => 'Layanan Laundry']);
    }
};
