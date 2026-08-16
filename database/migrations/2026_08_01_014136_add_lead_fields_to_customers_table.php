<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('source')->nullable()->after('message');
            $table->string('status')->default('baru')->after('source');
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['source', 'status', 'notes']);
        });
    }
};
