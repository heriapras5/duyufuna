<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('bookings');
    }

    public function down(): void
    {
        Schema::create('bookings', function ($table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->integer('total_people')->nullable();
            $table->text('note')->nullable();
            $table->string('source')->default('web');
            $table->timestamps();
        });
    }
};
