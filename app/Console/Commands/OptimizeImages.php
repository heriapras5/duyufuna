<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize {--dry-run : Tampilkan file yang akan diproses tanpa mengubah apa pun}';

    protected $description = 'Kompres otomatis gambar besar di storage/app/public (PNG->WebP, JPEG/WebP q85)';

    private const QUALITY = 85;

    private const THRESHOLD_BYTES = 204800;

    private array $tableMap = [
        'banners' => ['image'],
        'services' => ['image'],
        'service_items' => ['image'],
        'galleries' => ['image'],
        'articles' => ['image'],
        'notifications' => ['image'],
        'testimonials' => ['image'],
        'settings' => ['logo', 'banner_image', 'greeting_image', 'about_banner', 'about_image', 'og_image'],
    ];

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $disk = Storage::disk('public');

        $skip = $this->faviconPaths();
        $referenced = $this->referencedPaths();
        $files = array_values(array_filter($disk->allFiles(), function (string $file) use ($disk, $skip, $referenced) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                return false;
            }
            if (isset($skip[$file]) || !isset($referenced[$file]) || $disk->size($file) <= self::THRESHOLD_BYTES) {
                return false;
            }

            return true;
        }));

        if (empty($files)) {
            $this->info('Tidak ada gambar besar yang perlu dikompres.');

            return self::SUCCESS;
        }

        $processed = 0;
        $saved = 0;

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $before = $disk->size($file);

            try {
                if ($ext === 'png') {
                    $newPath = preg_replace('/\.png$/i', '.webp', $file);
                    if ($dryRun) {
                        $saved += (int) ($before * 0.5);
                        $this->line(sprintf('  [dry-run] %s -> %s (%.0f KB)', $file, $newPath, $before / 1024));
                    } else {
                        $saved += $this->convertPng($disk, $file, $newPath);
                        $this->updateDbReferences($file, $newPath);
                        $after = $disk->exists($newPath) ? $disk->size($newPath) : 0;
                        $this->line(sprintf('  [ok] %s -> %s (%.0f KB -> %.0f KB)', $file, $newPath, $before / 1024, $after / 1024));
                        $disk->delete($file);
                    }
                } else {
                    $saved += $this->reencodeInPlace($disk, $file, $ext, $dryRun);
                    $after = $dryRun ? $before : $disk->size($file);
                    $this->line(sprintf('  %s %s (%.0f KB -> %.0f KB)', $dryRun ? '[dry-run]' : '[ok]', $file, $before / 1024, $after / 1024));
                }
                $processed++;
            } catch (\Throwable $e) {
                $this->error(sprintf('  [skip] %s (%s)', $file, $e->getMessage()));
            }
        }

        $this->info(sprintf('Selesai: %d file diproses, menghemat ±%.1f MB.', $processed, $saved / 1048576));

        return self::SUCCESS;
    }

    private function faviconPaths(): array
    {
        return DB::table('settings')->whereNotNull('favicon')
            ->pluck('favicon')
            ->mapWithKeys(fn ($path) => [str_replace('\\', '/', (string) $path) => true])
            ->all();
    }

    private function referencedPaths(): array
    {
        $paths = [];
        foreach ($this->tableMap as $table => $columns) {
            foreach ($columns as $column) {
                foreach (DB::table($table)->whereNotNull($column)->pluck($column) as $path) {
                    $paths[str_replace('\\', '/', (string) $path)] = true;
                }
            }
        }

        return $paths;
    }

    private function convertPng($disk, string $file, string $newPath): int
    {
        $before = $disk->size($file);
        $image = Image::read($disk->path($file));
        $disk->put($newPath, $image->toWebp(quality: self::QUALITY));

        return max(0, $before - $disk->size($newPath));
    }

    private function reencodeInPlace($disk, string $file, string $ext, bool $dryRun): int
    {
        $before = $disk->size($file);

        if ($dryRun) {
            return max(0, (int) ($before * 0.25));
        }

        $image = Image::read($disk->path($file));
        $encoded = in_array($ext, ['webp', 'png']) ? $image->toWebp(quality: self::QUALITY) : $image->toJpeg(quality: self::QUALITY);
        $disk->put($file, $encoded);

        return max(0, $before - $disk->size($file));
    }

    private function updateDbReferences(string $oldPath, string $newPath): void
    {
        foreach ($this->tableMap as $table => $columns) {
            foreach ($columns as $column) {
                DB::table($table)->where($column, $oldPath)->update([$column => $newPath]);
            }
        }
    }
}
