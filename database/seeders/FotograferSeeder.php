<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Restrukturisasi layanan Fotografer sesuai price list asli (9 kegiatan).
 * Harga = price list + 50 SAR per kegiatan. Setiap kegiatan = 1 ServiceItem
 * di bawah 1 service induk "Fotografer", lengkap dengan gallery 4 gambar.
 *
 * Idempoten: aman dijalankan ulang — memakai updateOrCreate, galeri yang
 * sudah ada dipertahankan (tidak dihapus), hanya item usang yang dibersihkan.
 */
class FotograferSeeder extends Seeder
{
    public const SERVICE_TITLE = 'Fotografer';

    /** [title, sar (price list + 50), rupiah (sar x 5000)] */
    public const ITEMS = [
        ['title' => 'Ziarah Nabawi',                              'sar' => 300, 'idr' => 1_500_000],
        ['title' => 'City Tour Kota Madinah',                     'sar' => 300, 'idr' => 1_500_000],
        ['title' => 'Raudoh Laki-laki',                           'sar' => 200, 'idr' => 1_000_000],
        ['title' => 'Raudoh Perempuan (sekaligus Mutowifah)',     'sar' => 300, 'idr' => 1_500_000],
        ['title' => 'Dokumentasi Kereta Cepat',                   'sar' => 150, 'idr' => 750_000],
        ['title' => 'Umroh Pertama',                              'sar' => 300, 'idr' => 1_500_000],
        ['title' => 'City Tour Kota Mekkah dan Umroh 2',          'sar' => 400, 'idr' => 2_000_000],
        ['title' => 'City Tour Kota Thoif',                       'sar' => 300, 'idr' => 1_500_000],
        ['title' => 'City Tour Al Oula',                          'sar' => 750, 'idr' => 3_750_000],
    ];

    public function run(): void
    {
        $category = Category::where('slug', 'fotografer')->firstOrFail();

        // Pastikan kategori memakai tipe form dengan label "Kegiatan".
        $category->update([
            'page_type' => 'form',
            'item_label' => 'Kegiatan',
        ]);

        // Service induk "Fotografer" (satu-satunya; service lain di kategori ini dibersihkan).
        $service = Service::updateOrCreate(
            ['category_id' => $category->id, 'slug' => 'fotografer'],
            [
                'title' => self::SERVICE_TITLE,
                'short_description' => 'Layanan dokumentasi foto & video perjalanan ibadah oleh fotografer profesional.',
                'price' => 750_000, // termurah (Rupiah)
                'price_sar' => 150,     // termurah (SAR)
                'status' => true,
            ]
        );

        // Bersihkan service lain (placeholder lama) beserta file gambarnya.
        $staleServices = Service::where('category_id', $category->id)
            ->where('id', '!=', $service->id)
            ->get();
        foreach ($staleServices as $stale) {
            foreach ($stale->serviceItems as $staleItem) {
                $this->deleteImages($staleItem);
                $staleItem->delete();
            }
            if ($stale->image) {
                Storage::disk('public')->delete($stale->image);
            }
            $stale->delete();
        }

        $wantedTitles = collect(self::ITEMS)->pluck('title')->all();

        foreach (self::ITEMS as $i => $row) {
            $item = ServiceItem::where('service_id', $service->id)
                ->where('title', $row['title'])
                ->first();

            // Pertahankan galeri yang sudah ada & filenya masih valid.
            $existingGallery = $item && is_array($item->gallery)
                ? array_values(array_filter($item->gallery, fn ($p) => is_string($p) && Storage::disk('public')->exists($p)))
                : [];

            $gallery = $existingGallery !== []
                ? $existingGallery
                : $this->galleryPaths($row['title']);

            $payload = [
                'tagline' => 'Dokumentasi foto profesional',
                'description' => '<p>Sesi dokumentasi <b>'.e($row['title']).'</b> bersama fotografer berpengalaman. Hasil foto diedit dan dikirim melalui WhatsApp / Google Drive.</p>',
                'info' => 'Tarif: SAR '.number_format($row['sar'], 0, ',', '.').' (± Rp '.number_format($row['idr'], 0, ',', '.').') per kegiatan.',
                'price_per_night' => $row['sar'], // memakai kolom harga standar (SAR)
                'sort' => $i + 1,
                'status' => true,
                'gallery' => $gallery,
            ];

            if ($item) {
                $item->update($payload);
            } else {
                ServiceItem::create(array_merge($payload, [
                    'service_id' => $service->id,
                    'title' => $row['title'],
                ]));
            }
        }

        // Hapus item usang (mis. placeholder lama) yang tidak ada di daftar final.
        $obsolete = ServiceItem::where('service_id', $service->id)
            ->whereNotIn('title', $wantedTitles)
            ->get();
        foreach ($obsolete as $dead) {
            $this->deleteImages($dead);
            $dead->delete();
        }

        $this->command?->info('FotograferSeeder: 1 service + '.count(self::ITEMS).' kegiatan dibuat (harga = price list + 50 SAR).');
    }

    /**
     * Kembalikan 4 path galeri untuk sebuah kegiatan.
     * Prioritas: file galleries/foto-* yang sudah ada > salinan dari cache seeder.
     * Jika tidak ada sumber gambar sama sekali, kembalikan [] (view menampilkan placeholder).
     */
    protected function galleryPaths(string $title): array
    {
        $slug = Str::slug($title);

        // 1) Pakai ulang file galeri yang sudah ada untuk kegiatan ini.
        $disk = Storage::disk('public');
        $existing = collect($disk->files('galleries'))
            ->filter(fn ($p) => (bool) preg_match('/^galleries\/foto-'.preg_quote($slug, '/'). '-\d+\.(jpg|jpeg|png|webp)$/', $p))
            ->sort()
            ->values()
            ->all();
        if (count($existing) >= 4) {
            return array_slice($existing, 0, 4);
        }
        if ($existing !== []) {
            // Lengkapi hingga 4 dengan mengulang file yang ada.
            $out = $existing;
            while (count($out) < 4) {
                $out[] = $existing[count($out) % count($existing)];
            }
            return array_slice($out, 0, 4);
        }

        // 2) Salin 4 gambar dari cache seeder ke galleries/.
        $paths = [];
        $cacheDir = storage_path('app/public/.img-cache');
        $candidates = array_values(array_filter(
            glob($cacheDir.'/*.jpg') ?: [],
            fn ($f) => is_file($f) && filesize($f) > 1000
        ));

        // Pool fallback: foto galeri lain yang sudah ada.
        if ($candidates === []) {
            $pool = collect($disk->files('galleries'))
                ->filter(fn ($p) => (bool) preg_match('/\.(jpg|jpeg|png|webp)$/i', $p))
                ->values()
                ->all();
            for ($n = 1; $n <= 4 && $pool !== []; $n++) {
                $paths[] = $pool[($n - 1) % count($pool)];
            }
            return $paths;
        }

        // Keyword per kegiatan agar gambar relevan.
        $keywords = [
            'ziarah-nabawi'          => ['masjid-nabawi', 'madinah'],
            'city-tour-kota-madinah' => ['madinah', 'masjid-nabawi'],
            'raudoh-laki-laki'       => ['kaaba', 'islamic'],
            'raudoh-perempuan'       => ['kaaba', 'pilgrims'],
            'dokumentasi-kereta'     => ['train', 'travel'],
            'umroh-pertama'          => ['kaaba', 'islamic-pilgrimage'],
            'city-tour-kota-mekkah'  => ['kaaba', 'makkah'],
            'city-tour-kota-thoif'   => ['city', 'mosque'],
            'city-tour-al-oula'      => ['desert', 'saudi'],
        ];

        $key = Str::of($title)->slug()->before('sekaligus');
        foreach ($keywords as $prefix => $prefs) {
            if (Str::startsWith((string) $key, $prefix)) {
                $prefs = array_merge($prefs, ['photographer', 'camera', 'photography']);
                // Kumpulkan file cache yang cocok dengan keyword.
                $pool = [];
                foreach ($prefs as $pref) {
                    foreach ($candidates as $candidate) {
                        if (Str::contains(basename($candidate), $pref)) {
                            $pool[$candidate] = true;
                        }
                    }
                }
                $pool = array_keys($pool);

                for ($n = 1; $n <= 4; $n++) {
                    $name   = 'foto-'.Str::slug($title).'-'.$n.'.jpg';
                    $target = 'galleries/'.$name;

                    if (empty($pool)) {
                        break;
                    }
                    $source = $pool[($n - 1) % count($pool)];

                    if (! is_file(Storage::disk('public')->path($target))) {
                        copy($source, Storage::disk('public')->path($target));
                    }
                    $paths[] = $target;
                }
                break;
            }
        }

        // Fallback: kalau tidak ada keyword yang cocok, ambil gambar cache apa pun.
        if (empty($paths) && ! empty($candidates)) {
            for ($n = 1; $n <= 4; $n++) {
                $name   = 'foto-'.Str::slug($title).'-'.$n.'.jpg';
                $target = 'galleries/'.$name;
                $source = $candidates[($n - 1) % count($candidates)];
                if (! is_file(Storage::disk('public')->path($target))) {
                    copy($source, Storage::disk('public')->path($target));
                }
                $paths[] = $target;
            }
        }

        return $paths;
    }

    protected function deleteImages(ServiceItem $item): void
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        foreach ((array) $item->gallery as $path) {
            Storage::disk('public')->delete($path);
        }
    }
}
