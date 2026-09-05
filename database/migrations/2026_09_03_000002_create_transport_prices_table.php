<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transport_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('transport_routes')->cascadeOnDelete();
            $table->string('vehicle'); // Camry, Ford, Lexus, ...
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();

            $table->unique(['route_id', 'vehicle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_prices');
    }
};