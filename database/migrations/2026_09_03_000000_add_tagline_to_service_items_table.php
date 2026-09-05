<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('title');
        });

        $taglines = [
            'SILVER' => 'Paket ekonomis untuk rombongan besar',
            'GOLD' => 'Keseimbangan layanan dan harga terbaik',
            'PLATINUM' => 'Layanan VIP premium terlengkap',
        ];

        foreach ($taglines as $title => $tagline) {
            DB::table('service_items')
                ->join('services', 'service_items.service_id', '=', 'services.id')
                ->where('services.slug', 'handling-umroh')
                ->where('service_items.title', $title)
                ->update(['tagline' => $tagline]);
        }
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn('tagline');
        });
    }
};
