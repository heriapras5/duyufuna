<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->string('whatsapp', 20)->nullable()->after('sort');
            $table->text('wa_message')->nullable()->after('whatsapp');
        });
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'wa_message']);
        });
    }
};
