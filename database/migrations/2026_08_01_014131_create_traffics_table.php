<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('traffics', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->nullable();
            $table->string('menu')->nullable();
            $table->string('url')->nullable();
            $table->string('referrer')->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('device')->nullable();
            $table->boolean('is_lead')->default(false);
            $table->timestamps();

            $table->index(['created_at']);
            $table->index(['menu']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traffics');
    }
};
