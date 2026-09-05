<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('price_sar', 10, 2)->nullable()->after('price');
        });

        // Backfill price_sar from transport_prices min values
        $prices = DB::table('transport_prices')
            ->select('vehicle', DB::raw('MIN(price) as min_price'))
            ->whereNotNull('price')
            ->groupBy('vehicle')
            ->get();

        foreach ($prices as $p) {
            $slug = 'transport-' . strtolower($p->vehicle);
            DB::table('services')
                ->where('slug', $slug)
                ->whereNull('price_sar')
                ->update(['price_sar' => $p->min_price]);
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('price_sar');
        });
    }
};