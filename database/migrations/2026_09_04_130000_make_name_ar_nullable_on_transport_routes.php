<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Nama rute (Arab) tidak lagi ditampilkan & tidak lagi diisi dari form Admin.
    public function up(): void
    {
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->string('name_ar')->nullable(false)->change();
        });
    }
};
