<?php

use App\Services\HtmlNormalizer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Bersihkan sampah editor/AI (paragraf <br> kosong, anchor
     * aria-hidden, atribut data-*, class PDq2pG_*) pada konten HTML
     * yang tersimpan sebelum HtmlNormalizer dipakai saat simpan.
     * Idempotent: hanya baris yang berubah yang di-update.
     */
    public function up(): void
    {
        $targets = [
            ['articles', 'content'],
            ['services', 'description'],
            ['service_items', 'description'],
        ];

        foreach ($targets as [$table, $column]) {
            DB::table($table)
                ->whereNotNull($column)
                ->where($column, '<>', '')
                ->orderBy('id')
                ->chunkById(100, function ($rows) use ($table, $column) {
                    foreach ($rows as $row) {
                        $cleaned = HtmlNormalizer::clean($row->{$column});
                        if ($cleaned !== $row->{$column}) {
                            DB::table($table)->where('id', $row->id)->update([$column => $cleaned]);
                        }
                    }
                });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
