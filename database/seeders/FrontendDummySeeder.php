<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FrontendDummySeeder extends Seeder
{
    protected array $httpCtx = [];

    protected array $accentGroups = [
        'mekkah' => ['#0B3D2E', '#2DD4BF'],
        'madinah' => ['#0F766E', '#5EEAD4'],
        'hotel' => ['#065F46', '#34D399'],
        'visa' => ['#1E3A8A', '#38BDF8'],
        'transportasi' => ['#92400E', '#F59E0B'],
        'handling' => ['#7C5A12', '#D4A017'],
        'catering' => ['#A16207', '#FBBF24'],
        'laundry' => ['#0E7490', '#22D3EE'],
        'buggy' => ['#6B21A8', '#C084FC'],
        'jastip' => ['#B45309', '#FDE68A'],
        'kursi roda' => ['#065F46', '#A7F3D0'],
        'fotografer' => ['#7C3AED', '#A78BFA'],
        'penukaran' => ['#047857', '#6EE7B7'],
        'muthawif' => ['#004d2e', '#C9A227'],
    ];

    protected array $serviceKeywords = [
        'mekkah' => 'kaaba masjid haram makkah',
        'madinah' => 'masjid nabawi madinah mosque',
        'visa-umroh' => 'passport visa stamp',
        'transportasi-bus-shalawat' => 'shuttle bus group travel',
        'transportasi-bus-24jam' => 'tourist bus travel',
        'transportasi-hiace' => 'van minibus travel',
        'handling-umroh' => 'airport luggage arriving passengers',
        'kedatangan' => 'arabic rice food platter',
        'kepulangan' => 'packed food box meal',
        'laundry-kilat' => 'laundry folded clothes',
        'buggy-car-haram' => 'electric buggy car',
        'jastip-tumbler' => 'stainless water bottle',
        'jastip-parfum' => 'perfume bottle luxury',
        'jastip-kurma-sukari' => 'dates dried fruit',
        'jastip-tasbih' => 'prayer beads misbaha rosary',
        'kursi-roda-sewa' => 'wheelchair elderly assistance',
        'foto-semua-kegiatan' => 'photographer camera taking photo',
        'foto-khandmah' => 'photographer camera',
        'foto-pelataran' => 'camera photography',
        'penukaran-riyal' => 'saudi riyal currency money',
        'muthawif-per-hari' => 'kaaba pilgrims islamic',
    ];

    protected array $tokenKeywords = [
        'mekkah' => 'kaaba makkah mosque',
        'madinah' => 'masjid nabawi madinah',
        'hotel' => 'luxury hotel room',
        'visa' => 'visa passport',
        'shalawat' => 'shuttle bus',
        'transport' => 'bus travel',
        'handling' => 'airport luggage',
        'cater' => 'arabic rice food',
        'kabsah' => 'arabic chicken rice',
        'kebuli' => 'arabic rice dish',
        'mandhi' => 'arabic lamb rice',
        'snack' => 'spiced snacks',
        'laundry' => 'laundry clothes',
        'buggy' => 'electric buggy car',
        'kursi roda' => 'wheelchair',
        'motor wheelchair' => 'powered wheelchair',
        'fotografer' => 'photographer',
        'foto' => 'camera photography',
        'penukaran' => 'saudi riyal currency',
        'riyal' => 'saudi riyal cash',
        'dolar' => 'us dollar banknotes',
        'muthawif' => 'kaaba pilgrims',
        'ziarah' => 'islamic pilgrimage',
        'manasik' => 'kaaba islamic',
        'kurma' => 'dates fruit',
        'sukari' => 'dates dried fruit',
        'parfum' => 'perfume bottle',
        'attar' => 'oil perfume',
        'tasbih' => 'prayer beads misbaha',
        'tumbler' => 'stainless water bottle',
        'buggy vip' => 'electric buggy car',
    ];

    protected function accent(string $title): array
    {
        $fallback = ['#0B3D2E', '#2DD4BF'];
        foreach ($this->accentGroups as $key => $palette) {
            if (str_contains(strtolower($title), $key)) {
                return $palette;
            }
        }
        return $fallback;
    }

    protected function hex2rgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }

    /** Generate a branded gradient placeholder (fallback). */
    protected function gradient(string $title, string $emoji = ''): array
    {
        [$from, $to] = $this->accent($title);
        $w = 800;
        $h = 600;
        $img = imagecreatetruecolor($w, $h);
        $f = $this->hex2rgb($from);
        $t = $this->hex2rgb($to);
        for ($y = 0; $y < $h; $y++) {
            $r = (int) ($f[0] + ($t[0] - $f[0]) * $y / $h);
            $g = (int) ($f[1] + ($t[1] - $f[1]) * $y / $h);
            $b = (int) ($f[2] + ($t[2] - $f[2]) * $y / $h);
            imageline($img, 0, $y, $w, $y, imagecolorallocate($img, $r, $g, $b));
        }
        imagefilledellipse($img, (int) ($w * 0.85), 60, 360, 360, imagecolorallocatealpha($img, 255, 255, 255, 110));
        imagefilledellipse($img, 120, 540, 420, 420, imagecolorallocatealpha($img, 245, 215, 110, 60));

        $white = imagecolorallocate($img, 255, 255, 255);
        $gold = imagecolorallocate($img, 245, 215, 110);
        if ($emoji !== '') {
            $eFont = $this->findFont(['C:/Windows/Fonts/seguiemj.ttf', 'C:/Windows/Fonts/arial.ttf']);
            if ($eFont) {
                imagettftext($img, 110, 0, 70, 200, $white, $eFont, $emoji);
            }
        }
        $tf = $this->findFont(['C:/Windows/Fonts/arialbd.ttf', 'C:/Windows/Fonts/arial.ttf']);
        if ($tf) {
            $tb = imagettfbbox(30, 0, $tf, mb_strimwidth($title, 0, 60, '...'));
            $tw = abs($tb[2] - $tb[0]);
            imagettftext($img, 30, 0, (int) ((800 - $tw) / 2), 420, $white, $tf, mb_strimwidth($title, 0, 60, '...'));
        }
        return [$img, $w, $h];
    }

    protected function findFont(array $candidates): ?string
    {
        foreach ($candidates as $font) {
            if (is_file($font)) {
                return $font;
            }
        }
        return null;
    }

    /** Ensure a keyword's real photo is cached; return jpeg binary string or false. */
    protected function download(string $keyword): string|false
    {
        $cache = storage_path('app/public/.img-cache/' . Str::slug($keyword) . '.jpg');
        if (is_file($cache) && filesize($cache) > 1000) {
            return file_get_contents($cache);
        }
        @mkdir(dirname($cache), 0777, true);

        $url = 'https://api.openverse.org/v1/images/'
            . '?q=' . rawurlencode($keyword)
            . '&license_type=commercial&page_size=5&size=medium';

        $ctx = stream_context_create([
            'http' => ['timeout' => 20, 'header' => "User-Agent: DUYUFUNA/1.0\r\nAccept: application/json\r\n"],
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
        ]);

        $json = @file_get_contents($url, false, $ctx);
        if ($json === false) {
            return false;
        }
        $data = json_decode($json, true);
        if (! is_array($data) || empty($data['results'])) {
            return false;
        }

        foreach ($data['results'] as $c) {
            $src = $c['thumbnail'] ?? $c['url'] ?? null;
            if (! is_string($src)) {
                continue;
            }
            $img = @file_get_contents($src, false, $ctx);
            if ($img === false || strlen($img) < 1000) {
                continue;
            }
            $parsed = @imagecreatefromstring($img);
            if (! $parsed) {
                continue;
            }
            imagejpeg($parsed, $cache, 85);
            imagedestroy($parsed);
            return file_get_contents($cache);
        }
        return false;
    }

    /** Resize any image bytes to 800x600 jpeg (landscape cover). */
    protected function fitToJpeg(string|null $bytes): string|false
    {
        if (! $bytes) {
            return false;
        }
        $src = @imagecreatefromstring($bytes);
        if (! $src) {
            return false;
        }
        $W = imagesx($src);
        $H = imagesy($src);

        $w=800;
        $h=600;
        $scale = max($w/$W, $h/$H);
        $nw = max(1, (int) round($W*$scale));
        $nh = max(1, (int) round($H*$scale));
        $out = imagecreatetruecolor($w, $h);
        imagecopyresampled($out, $src, 0, 0, 0, 0, $w, $h, $nw, $nh);
        imagedestroy($src);

        $tmp = fopen('php://temp', 'r+');
        imagejpeg($out, $tmp, 85);
        rewind($tmp);
        $bin = stream_get_contents($tmp);
        fclose($tmp);
        imagedestroy($out);
        return $bin;
    }

    protected function categoryEmoji(?Service $service): string
    {
        if ($service && $service->category && $service->category->icon) {
            return trim($service->category->icon);
        }
        return '🕋';
    }

    protected function textKeyword(string $title): ?string
    {
        foreach ($this->tokenKeywords as $token => $kw) {
            if (str_contains(strtolower($title), $token)) {
                return $kw;
            }
        }
        return null;
    }

    protected function slugKeyword(string $slug): ?string
    {
        return $this->serviceKeywords[$slug] ?? null;
    }

    /** Produce a real photo file path for $dir; gradient fallback if download fails. */
    protected function photo(string $dir, string $title, string $emoji, ?string $keyword): string
    {
        $rels = [];
        if ($keyword) {
            $binSummer = $this->download($keyword);
            if ($binSummer !== false) {
                $jpeg = $this->fitToJPEG($binSummer);
                if ($jpeg !== false) {
                    @mkdir(storage_path('app/public/' . $dir), 0777, true);
                    $rel = $dir . '/' . Str::slug($title) . '-' . Str::random(6) . '.jpg';
                    file_put_contents(storage_path('app/public/' . $rel), $jpeg);
                    return $rel;
                }
            }
        }

        [$img, $w, $h] = $this->gradient($title, $emoji);
        @mkdir(storage_path('app/public/' . $dir), 0777, true);
        $rel = $dir . '/' . Str::slug($title) . '-' . Str::random(6) . '.jpg';
        imagejpeg($img, storage_path('app/public/' . $rel), 85);
        imagedestroy($img);
        return $rel;
    }

    protected function seedServices(): void
    {
        $services = Service::with('category')->orderBy('id')->get();

        foreach ($services as $service) {
            $kw = $this->slugKeyword($service->slug) ?: $this->textKeyword($service->title);
            $service->image = $this->photo('services', $service->title, $this->categoryEmoji($service), $kw ?: null);
            $service->save();
        }

        foreach ($services as $service) {
            $pool = $this->findPool($service->title);
            if (! $pool) {
                continue;
            }
            if (! empty($pool['sync'])) {
                ServiceItem::where('service_id', $service->id)->delete();
            }
            if ($service->serviceItems()->count() > 0) {
                continue;
            }
            $sort = 1;
            $baseKw = $this->slugKeyword($service->slug) ?: $this->textKeyword($service->title);
            $defaultDesc = $pool['description'] ?? null;
            foreach ($pool['items'] as $poolItem) {
                $itemTitle = is_array($poolItem) ? $poolItem['title'] : $poolItem;
                $kw = $this->textKeyword($itemTitle) ?: $baseKw;
                ServiceItem::updateOrCreate(
                    ['service_id' => $service->id, 'title' => $itemTitle],
                    [
                        'image' => $this->photo('service-items', $service->title . ' - ' . $itemTitle, $this->categoryEmoji($service), $kw),
                        'description' => is_array($poolItem) ? ($poolItem['description'] ?? null) : ($defaultDesc ?? '<p>Pilihan ' . $itemTitle . ' dari ' . $service->title . ' yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>'),
                        'info' => is_array($poolItem) ? ($poolItem['info'] ?? null) : null,
                        'benefit' => is_array($poolItem) ? ($poolItem['benefit'] ?? null) : null,
                        'pax_prices' => is_array($poolItem) ? ($poolItem['pax_prices'] ?? null) : null,
                        'price_per_night' => is_array($poolItem) ? ($poolItem['price'] ?? null) : ($pool['price'] ?? null),
                        'sort' => $sort,
                        'status' => true,
                    ]
                );
                $sort++;
            }
        }

        foreach ($services as $service) {
            $baseKw = $this->slugKeyword($service->slug) ?: $this->textKeyword($service->title);
            foreach ($service->serviceItems as $item) {
                $kw = $this->textKeyword($item->title) ?: $baseKw;
                $item->image = $this->photo('service-items', $service->title . ' - ' . $item->title, $this->categoryEmoji($service), $kw);
                $item->save();
            }
        }
    }

    protected function findPool(string $title): ?array
    {
        foreach ($this->pools() as $pool) {
            if (str_contains(strtolower($title), strtolower($pool['title']))) {
                return $pool;
            }
        }
        return null;
    }

    protected function pools(): array
    {
        return [
            ['title' => 'Visa', 'items' => ['Visa 30 Hari', 'Visa 60 Hari', 'Visa Perpanjangan']],
            ['title' => 'Handling Bandara', 'items' => ['Penyambutan VIP', 'Antre Prioritas', 'Penjemputan Bagasi', 'Check-in Express', 'Layanan Bagasi', 'Pemandu Fasilitas']],
            ['title' => 'Handling', 'sync' => true, 'items' => [
                ['title' => 'SILVER', 'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5"><li>35–47 Pax — $73.00/Pax</li><li>25–34 Pax — $78.00/Pax</li><li>16–24 Pax — $98.00/Pax</li><li>11–15 Pax — $173.00/Pax</li></ul>', 'benefit' => "Handling Bandara Kedatangan & Kepulangan\nTipping Bandara\nMeal Box Kedatangan & Kepulangan\nCheck In & Check Out Hotel Mekkah & Madinah\nTeam Distribusi Koper depan kamar Jamaah\nSnack City Tour Mekkah, Madinah & Thaif\nWelcome Drink hotel kedatangan pertama\nAir Zam-Zam 5 Liter\nMuthawwifah Raudhah", 'pax_prices' => [['min' => 35, 'max' => 47, 'price' => 73], ['min' => 25, 'max' => 34, 'price' => 78], ['min' => 16, 'max' => 24, 'price' => 98], ['min' => 11, 'max' => 15, 'price' => 173]]],
                ['title' => 'GOLD', 'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5"><li>35–47 Pax — $80.00/Pax</li><li>25–34 Pax — $85.00/Pax</li><li>16–24 Pax — $105.00/Pax</li><li>11–15 Pax — $181.00/Pax</li></ul>', 'benefit' => "Handling Bandara Kedatangan & Kepulangan\nTipping Bandara\nMeal Box Kedatangan & Kepulangan\nCheck In & Check Out Hotel Mekkah & Madinah\nTeam Distribusi Koper depan kamar Jamaah\nSnack City Tour Mekkah, Madinah & Thaif\nWelcome Drink hotel kedatangan pertama\nAir Zam-Zam 5 Liter & Al Baik\nMuthawwifah Raudhah", 'pax_prices' => [['min' => 35, 'max' => 47, 'price' => 80], ['min' => 25, 'max' => 34, 'price' => 85], ['min' => 16, 'max' => 24, 'price' => 105], ['min' => 11, 'max' => 15, 'price' => 181]]],
                ['title' => 'PLATINUM', 'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5"><li>35–47 Pax — $93.00/Pax</li><li>25–34 Pax — $108.00/Pax</li><li>16–24 Pax — $123.00/Pax</li><li>4–15 Pax — $193.00/Pax</li></ul>', 'benefit' => "Handling Bandara Kedatangan & Kepulangan\nTipping Bandara\nMeal Box Kedatangan & Kepulangan\nCheck In & Check Out Hotel Mekkah & Madinah\nTeam Distribusi Koper depan kamar Jamaah\nSnack City Tour Mekkah, Madinah & Thaif\nWelcome Drink hotel kedatangan pertama\nAir Zam-Zam 5 Liter & Al Baik\nMuthawwifah Raudhah\nWelcome Food di kamar Jamaah (Air Zam-Zam 5 L, Kurma, Buah)", 'pax_prices' => [['min' => 35, 'max' => 47, 'price' => 93], ['min' => 25, 'max' => 34, 'price' => 108], ['min' => 16, 'max' => 24, 'price' => 123], ['min' => 4, 'max' => 15, 'price' => 193]]],
            ]],
            ['title' => 'Laundry', 'sync' => true, 'items' => [
                ['title' => 'Laundry 1–5 kg', 'price' => 15, 'info' => 'Waktu pengerjaan ± 24 jam · Antar-jemput ke kamar hotel'],
                ['title' => 'Laundry 5–10 kg', 'price' => 13, 'info' => 'Waktu pengerjaan ± 24 jam · Antar-jemput ke kamar hotel'],
            ]],
            ['title' => 'Buggy', 'sync' => true, 'items' => [
                ['title' => 'Tawaf', 'price' => 110, 'info' => 'Layanan buggy antar-jemput mengelilingi Ka\'bah'],
                ['title' => 'Sa\'i', 'price' => 110, 'info' => 'Layanan buggy antar-jemput Safa–Marwah'],
                ['title' => 'Umroh (Tawaf + Sa\'i)', 'price' => 220, 'info' => 'Paket lengkap Tawaf + Sa\'i, lebih hemat'],
            ]],
            ['title' => 'Kursi Roda', 'sync' => true, 'items' => [
                ['title' => 'Tawaf', 'price' => 150, 'info' => 'Didorong petugas berpengalaman mengelilingi Ka\'bah'],
                ['title' => 'Sa\'i', 'price' => 150, 'info' => 'Didorong petugas via jalur Safa–Marwah'],
                ['title' => 'Umroh (Tawaf + Sa\'i)', 'price' => 350, 'info' => 'Paket lengkap dengan pendampingan petugas'],
            ]],
            ['title' => 'Fotografer', 'items' => ['Paket Foto Dokumentasi', 'Paket Edisi Eksklusif', 'Paket Video Cinematic']],
            ['title' => 'Penukaran', 'items' => ['Riyal Cash', 'Dolar ke Riyal', 'Kirim Uang']],
            ['title' => 'Muthawif', 'sync' => true, 'price' => 300, 'description' => '<p>Muthawif Harian, Mingguan &amp; Bulanan</p>', 'items' => ['Mohammad Jadid', 'A. Najian Muzaki', 'Asep Saepuloh', 'Faqih Nur Fahmi']],
        ];
    }

    protected function seedTestimonials(): void
    {
        $list = [
            ['name' => 'Ibu Asih', 'review' => 'Terima kasih DUYUFUNA, semua diurus rapi mulai visa, hotel, sampai transportasi. Ibadah kami jadi tenang.', 'rating' => 5],
            ['name' => 'Bp. Dwi Cahyono', 'review' => 'Handling dan catering-nya top, petugas ramah. Sangat direkomendasikan untuk keluarga.', 'rating' => 4],
        ];
        foreach ($list as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                ['review' => $t['review'], 'rating' => $t['rating'], 'status' => true]
            );
        }
    }

    public function run(): void
    {
        $this->seedServices();
        $this->seedTestimonials();
    }
}