<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->string('area')->nullable()->after('map_link');
            $table->string('walk_time')->nullable()->after('area');
            $table->string('room_types')->nullable()->after('walk_time');
            $table->text('recommendation')->nullable()->after('benefit');
        });
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn(['area', 'walk_time', 'room_types', 'recommendation']);
        });
    }
};