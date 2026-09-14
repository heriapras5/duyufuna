<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryContentSeeder extends Seeder
{
    protected array $palettes = [
        ['#0B3D2E', '#14B8A6'],
        ['#0F766E', '#2DD4BF'],
        ['#065F46', '#34D399'],
        ['#7C5A12', '#D4A017'],
        ['#1E3A8A', '#38BDF8'],
        ['#92400E', '#F59E0B'],
        ['#134E4A', '#5EEAD4'],
        ['#6B21A8', '#C084FC'],
    ];

    protected array $services = [
        60 => ['Mekkah', '🕋', 0],
        61 => ['Madinah', '🕌', 1],
        71 => ['Kedatangan', '🛬', 3],
        72 => ['Kepulangan', '🛫', 4],
        75 => ['Tumbler Tanah Suci', '🥤', 5],
        76 => ['Parfum Timur Tengah', '🧴', 6],
        77 => ['Kurma Sukari', '🌴', 7],
        78 => ['Tasbih Kayu', '📿', 0],
    ];

    protected array $itemEmojis = [
        60 => '🏨',
        61 => '🏨',
        71 => '🍽️',
        72 => '🍽️',
    ];

    public function run(): void
    {
        foreach ($this->services as $id => [$title, $emoji, $palette]) {
            $service = Service::find($id);
            if (!$service) {
                continue;
            }

            if (!$service->image) {
                $service->image = $this->makePlaceholder('categories', $title, $emoji, $palette);
                $service->save();
            }

            if (!$service->short_description) {
                $service->short_description = $service->category_id === 1
                    ? 'Rekomendasi hotel-hotel terbaik di ' . $service->title . ' untuk kenyamanan ibadah Anda.'
                    : 'Pilihan ' . $service->title . ' terbaik untuk jamaah dengan layanan prima.';
                $service->save();
            }

            if (isset($this->itemEmojis[$id])) {
                foreach ($service->serviceItems as $item) {
                    if (!$item->image) {
                        $item->image = $this->makePlaceholder('categories', $item->title, $this->itemEmojis[$id], $palette);
                        $item->save();
                    }
                }
            }
        }
    }

    protected function makePlaceholder(string $dir, string $title, string $emoji, int $palette): string
    {
        [$from, $to] = $this->palettes[$palette % count($this->palettes)];
        $safe = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $name = Str::slug($title);
        $path = $dir . '/' . $name . '-' . Str::random(6) . '.svg';

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{$from}"/>
      <stop offset="100%" stop-color="{$to}"/>
    </linearGradient>
  </defs>
  <rect width="800" height="600" fill="url(#g)"/>
  <circle cx="670" cy="80" r="180" fill="#ffffff" opacity="0.08"/>
  <circle cx="100" cy="540" r="210" fill="#C9A227" opacity="0.14"/>
  <text x="400" y="280" font-size="130" text-anchor="middle" dominant-baseline="central">{$emoji}</text>
  <text x="400" y="435" font-size="40" font-weight="700" text-anchor="middle" fill="#ffffff" font-family="Poppins, Arial, sans-serif">{$safe}</text>
</svg>
SVG;

        Storage::disk('public')->put($path, $svg);

        return $path;
    }
}
