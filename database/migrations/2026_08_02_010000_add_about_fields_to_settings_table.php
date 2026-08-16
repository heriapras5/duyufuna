<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('about_banner')->nullable()->after('greeting_image');
            $table->string('about_title')->nullable()->after('about_banner');
            $table->text('about_body')->nullable()->after('about_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['about_banner', 'about_title', 'about_body']);
        });
    }
};