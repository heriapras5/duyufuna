<?php

use App\Services\SlugService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('service_items')
            ->orderBy('id')
            ->each(function ($row) {
                if (empty($row->slug)) {
                    $slug = app(SlugService::class)->make((string) $row->title, 'service_items', $row->id);
                    DB::table('service_items')->where('id', $row->id)->update(['slug' => $slug]);
                }
            });
    }

    public function down(): void
    {
        // No-op: generated slugs are additive and safe to keep.
    }
};
