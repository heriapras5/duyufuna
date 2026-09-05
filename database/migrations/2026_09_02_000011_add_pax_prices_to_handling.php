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
            $table->json('pax_prices')->nullable()->after('info');
        });

        $tiers = [
            'SILVER' => [
                ['min' => 35, 'max' => 47, 'price' => 73],
                ['min' => 25, 'max' => 34, 'price' => 78],
                ['min' => 16, 'max' => 24, 'price' => 98],
                ['min' => 11, 'max' => 15, 'price' => 173],
            ],
            'GOLD' => [
                ['min' => 35, 'max' => 47, 'price' => 80],
                ['min' => 25, 'max' => 34, 'price' => 85],
                ['min' => 16, 'max' => 24, 'price' => 105],
                ['min' => 11, 'max' => 15, 'price' => 181],
            ],
            'PLATINUM' => [
                ['min' => 35, 'max' => 47, 'price' => 93],
                ['min' => 25, 'max' => 34, 'price' => 108],
                ['min' => 16, 'max' => 24, 'price' => 123],
                ['min' => 4, 'max' => 15, 'price' => 193],
            ],
        ];

        foreach ($tiers as $title => $data) {
            DB::table('service_items')
                ->join('services', 'service_items.service_id', '=', 'services.id')
                ->where('services.slug', 'handling-umroh')
                ->where('service_items.title', $title)
                ->update(['pax_prices' => json_encode($data)]);
        }
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn('pax_prices');
        });
    }
};