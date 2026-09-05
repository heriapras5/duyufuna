<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah slug service catering menjadi lebih singkat:
     * catering-bandara-datang -> kedatangan
     * catering-bandara-pulang -> kepulangan
     */
    public function up(): void
    {
        $this->rename('catering-bandara-datang', 'kedatangan');
        $this->rename('catering-bandara-pulang', 'kepulangan');
    }

    public function down(): void
    {
        $this->rename('kedatangan', 'catering-bandara-datang');
        $this->rename('kepulangan', 'catering-bandara-pulang');
    }

    private function rename(string $oldSlug, string $newSlug): void
    {
        $cateringId = DB::table('categories')->where('slug', 'catering')->value('id');
        if (! $cateringId) {
            return;
        }

        DB::table('services')
            ->where('category_id', $cateringId)
            ->where('slug', $oldSlug)
            ->update(['slug' => $newSlug]);
    }
};
