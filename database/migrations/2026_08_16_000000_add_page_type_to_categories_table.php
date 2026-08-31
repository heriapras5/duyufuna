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
            $table->string('page_type', 20)->default('cards')->after('is_catalog');
        });

        DB::table('categories')->where('is_catalog', true)->update(['page_type' => 'catalog']);
        DB::table('categories')->where('slug', 'transportasi')->update(['page_type' => 'transport']);
        DB::table('categories')->whereIn('slug', [
            'laundry',
            'buggy-car',
            'kursi-roda-umroh',
            'fotografer',
            'penukaran-uang',
            'muthawif',
        ])->update(['page_type' => 'form']);
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('page_type');
        });
    }
};