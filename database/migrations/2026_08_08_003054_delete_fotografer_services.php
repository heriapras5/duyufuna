<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $categoryId = DB::table('categories')->where('slug', 'fotografer')->value('id');
        if (!$categoryId) {
            return;
        }

        $serviceIds = DB::table('services')->where('category_id', $categoryId)->pluck('id');

        DB::table('service_items')->whereIn('service_id', $serviceIds)->delete();
        DB::table('services')->where('category_id', $categoryId)->delete();
    }

    public function down(): void
    {
        $categoryId = DB::table('categories')->where('slug', 'fotografer')->value('id');
        if (!$categoryId) {
            return;
        }

        $slug = 'foto-semua-kegiatan';
        $exists = DB::table('services')->where('slug', $slug)->exists();
        if ($exists) {
            return;
        }

        DB::table('services')->insert([
            'category_id'      => $categoryId,
            'title'            => 'Semua Jenis Kegiatan',
            'slug'             => $slug,
            'short_description'=> 'Pendokumentasian seluruh momen ibadah Anda',
            'description'      => '<p>Layanan dokumentasi fotografi profesional untuk mendokumentasikan momen ibadah Anda di Tanah Suci.</p>',
            'status'           => true,
            'price'            => 300000,
            'icon'             => '📸',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }
};