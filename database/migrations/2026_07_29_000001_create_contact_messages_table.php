<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('form');
            $table->string('sender_name');
            $table->string('sender_email')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->text('reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->foreignId('replied_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_read')->default(false);
            $table->string('wa_message_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
