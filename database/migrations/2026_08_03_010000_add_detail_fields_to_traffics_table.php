<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('traffics', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('menu');
            $table->string('no_hp', 20)->nullable()->after('nama');
            $table->string('category')->nullable()->after('no_hp');
            $table->string('service')->nullable()->after('category');
            $table->string('status')->default('baru')->after('service');
        });

        DB::table('traffics')->where('is_lead', true)->delete();
    }

    public function down(): void
    {
        Schema::table('traffics', function (Blueprint $table) {
            $table->dropColumn(['nama', 'no_hp', 'category', 'service', 'status']);
        });
    }
};
