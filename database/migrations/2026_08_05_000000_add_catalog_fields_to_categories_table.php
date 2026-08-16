<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_catalog')->default(false)->after('sort');
            $table->string('group_label')->nullable()->after('is_catalog');
            $table->string('item_label')->nullable()->after('group_label');
        });

        $labels = [
            'hotel' => ['group' => 'Kota', 'item' => 'Hotel'],
            'transportasi' => ['group' => 'Jenis Kendaraan', 'item' => 'Kendaraan'],
            'catering-bandara' => ['group' => 'Paket', 'item' => 'Paket'],
            'jastip-viral' => ['group' => 'Produk', 'item' => 'Produk'],
        ];

        foreach ($labels as $slug => $label) {
            DB::table('categories')
                ->where('slug', $slug)
                ->update([
                    'is_catalog' => true,
                    'group_label' => $label['group'],
                    'item_label' => $label['item'],
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['is_catalog', 'group_label', 'item_label']);
        });
    }
};