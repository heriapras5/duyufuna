<?php

use App\Models\ServiceItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        $items = ServiceItem::whereHas('service.category', function ($q) {
            $q->where('slug', 'visa');
        })->whereNotNull('image')->get();

        foreach ($items as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->update(['image' => null, 'gallery' => null]);
        }
    }

    public function down(): void
    {
        // Tidak bisa rollback penghapusan file
    }
};