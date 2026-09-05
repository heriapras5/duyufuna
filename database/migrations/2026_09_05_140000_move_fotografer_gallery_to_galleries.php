<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    // Memindahkan file galeri kegiatan fotografer dari service-items/ ke galleries/
    // (path di kolom service_items.gallery ikut diperbarui).
    public function up(): void
    {
        $items = DB::table('service_items')
            ->whereIn('service_id', function ($q) {
                $q->select('id')->from('services')
                    ->whereIn('category_id', function ($q2) {
                        $q2->select('id')->from('categories')->where('slug', 'fotografer');
                    });
            })
            ->get(['id', 'gallery']);

        foreach ($items as $item) {
            $gallery = json_decode($item->gallery ?? '[]', true);
            if (! is_array($gallery) || $gallery === []) {
                continue;
            }

            $updated = [];
            $changed = false;

            foreach ($gallery as $path) {
                if (! is_string($path) || ! str_starts_with($path, 'service-items/')) {
                    $updated[] = $path;
                    continue;
                }

                $target = 'galleries/' . basename($path);

                if (Storage::disk('public')->exists($path)) {
                    if (! Storage::disk('public')->exists($target)) {
                        Storage::disk('public')->move($path, $target);
                    }
                    $updated[] = $target;
                    $changed = true;
                } elseif (Storage::disk('public')->exists($target)) {
                    // File sudah berada di galleries/ (migrasi sebagian), cukup perbarui path.
                    $updated[] = $target;
                    $changed = true;
                } else {
                    // File fisik tidak ditemukan di kedua lokasi — biarkan path apa adanya.
                    $updated[] = $path;
                }
            }

            if ($changed) {
                DB::table('service_items')->where('id', $item->id)->update([
                    'gallery' => json_encode($updated),
                ]);
            }
        }
    }

    public function down(): void
    {
        $items = DB::table('service_items')
            ->whereIn('service_id', function ($q) {
                $q->select('id')->from('services')
                    ->whereIn('category_id', function ($q2) {
                        $q2->select('id')->from('categories')->where('slug', 'fotografer');
                    });
            })
            ->get(['id', 'gallery']);

        foreach ($items as $item) {
            $gallery = json_decode($item->gallery ?? '[]', true);
            if (! is_array($gallery) || $gallery === []) {
                continue;
            }

            $updated = [];
            $changed = false;

            foreach ($gallery as $path) {
                if (! is_string($path) || ! str_starts_with($path, 'galleries/')) {
                    $updated[] = $path;
                    continue;
                }

                $target = 'service-items/' . basename($path);

                if (Storage::disk('public')->exists($path)) {
                    if (! Storage::disk('public')->exists($target)) {
                        Storage::disk('public')->move($path, $target);
                    }
                    $updated[] = $target;
                    $changed = true;
                } else {
                    $updated[] = $path;
                }
            }

            if ($changed) {
                DB::table('service_items')->where('id', $item->id)->update([
                    'gallery' => json_encode($updated),
                ]);
            }
        }
    }
};
