<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Notification;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupOrphanImages extends Command
{
    protected $signature = 'storage:cleanup-images {--dry-run : Tampilkan file yang akan dihapus tanpa menghapus} {--list : Tampilkan daftar file yang dihapus}';

    protected $description = 'Hapus file gambar di storage/public yang tidak direferensikan database';

    protected array $directories = [
        'articles',
        'banners',
        'galleries',
        'notifications',
        'service-items',
        'services',
        'settings',
        'testimonials',
    ];

    protected array $whitelist = [
        'bg/bg-login.png',
    ];

    public function handle(): int
    {
        $referenced = $this->collectReferencedPaths();

        foreach ($this->whitelist as $path) {
            $referenced->push($path);
        }

        $referenced = $referenced->map(fn ($path) => trim((string) $path, '/'))->filter()->unique();

        $deleted = 0;
        $kept = 0;

        foreach ($this->directories as $directory) {
            if (! Storage::disk('public')->exists($directory)) {
                continue;
            }

            foreach (Storage::disk('public')->allFiles($directory) as $file) {
                $file = str_replace('\\', '/', $file);

                if (! $this->isImage($file)) {
                    $kept++;
                    continue;
                }

                if ($referenced->contains($file)) {
                    $kept++;
                    continue;
                }

                $deleted++;

                if ($this->option('list')) {
                    $this->line("  [hapus] {$file}");
                }

                if (! $this->option('dry-run')) {
                    Storage::disk('public')->delete($file);
                }
            }
        }

        $mode = $this->option('dry-run') ? 'SIMULASI (dry-run)' : 'SELESAI';
        $this->info("[{$mode}] Dipindai: {$this->countScanned()} file, dihapus: {$deleted}, dipertahankan: {$kept}");

        return self::SUCCESS;
    }

    protected function countScanned(): int
    {
        $count = 0;

        foreach ($this->directories as $directory) {
            if (Storage::disk('public')->exists($directory)) {
                $count += count(Storage::disk('public')->allFiles($directory));
            }
        }

        return $count;
    }

    protected function isImage(string $path): bool
    {
        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
    }

    protected function collectReferencedPaths(): \Illuminate\Support\Collection
    {
        $paths = collect();

        foreach ([
            Service::query()->pluck('image'),
            ServiceItem::query()->pluck('image'),
            Banner::query()->pluck('image'),
            Article::query()->pluck('image'),
            Gallery::query()->pluck('image'),
            Testimonial::query()->pluck('image'),
            Notification::query()->pluck('image'),
        ] as $collection) {
            $paths = $paths->merge($collection);
        }

        $settings = Setting::query()->first();

        if ($settings) {
            $paths = $paths->merge([
                $settings->logo,
                $settings->favicon,
                $settings->banner_image,
                $settings->greeting_image,
            ]);
        }

        return $paths;
    }
}
