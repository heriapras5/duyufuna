<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transport_routes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10); // 01, 02, ...
            $table->string('name_ar'); // Arabic name
            $table->string('pickup_label'); // Bandara Jeddah, Bandara Madinah, Bandara Haramain Madinah
            $table->string('dropoff_label'); // Jeddah, Makkah, Hotel Madinah, Madinah (1), Madinah (2), Madinah (4 Jam), Madinah (6 Jam #1-4)
            $table->unsignedTinyInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_routes');
    }
};