<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $old = '6281234567890';

        foreach (['settings', 'services', 'service_items'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'whatsapp')) {
                DB::table($table)->where('whatsapp', $old)->update(['whatsapp' => null]);
            }
        }

        Cache::forget('setting');
    }

    public function down(): void
    {
    }
};