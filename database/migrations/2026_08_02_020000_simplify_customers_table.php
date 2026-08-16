<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'message', 'source', 'status', 'notes']);
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->after('alamat')->constrained()->onDelete('set null');
            $table->text('message')->nullable()->after('service_id');
            $table->string('source')->nullable()->after('message');
            $table->string('status')->default('baru')->after('source');
            $table->text('notes')->nullable()->after('status');
        });
    }
};