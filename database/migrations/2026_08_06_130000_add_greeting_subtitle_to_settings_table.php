<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'greeting_subtitle')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('greeting_subtitle')->nullable()->after('greeting_title');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('settings', 'greeting_subtitle')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('greeting_subtitle');
            });
        }
    }
};