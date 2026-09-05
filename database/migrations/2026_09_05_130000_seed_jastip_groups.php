<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Menyamakan kategori Jastip Viral dengan produksi:
    // hapus grup "Tumbler Tanah Suci", buat 3 grup + 9 item (harga umum SAR 100), perbarui deskripsi kategori.
    protected string $categoryDescription = 'Layanan titip belanja berbagai produk populer dari Arab Saudi untuk jamaah yang ingin membawa oleh-oleh atau memenuhi permintaan keluarga dan kerabat di Indonesia.';

    protected string $oldCategoryDescription = 'Titip beli oleh-oleh viral dan kekinian dari Tanah Suci.';

    protected function groups(): array
    {
        return [
            'oleh-oleh-khas-arab-saudi' => [
                'title' => 'Oleh-Oleh Khas Arab Saudi',
                'short_description' => 'Berbagai oleh-oleh khas Tanah Suci yang populer dibawa pulang oleh jamaah.',
                'items' => [
                    'Kurma Ajwa' => 'Kurma Ajwa dari Madinah yang menjadi salah satu oleh-oleh favorit jamaah untuk dibawa pulang sebagai buah tangan bagi keluarga dan kerabat di Indonesia.',
                    'Kurma Premium' => 'Pilihan berbagai jenis kurma berkualitas dari Arab Saudi dengan kemasan yang cocok untuk oleh-oleh.',
                    'Cokelat Arab' => 'Beragam cokelat khas dan populer di Arab Saudi yang dapat menjadi pilihan oleh-oleh praktis untuk keluarga maupun rekan kerja.',
                ],
            ],
            'oleh-oleh-islami' => [
                'title' => 'Oleh-Oleh Islami',
                'short_description' => 'Pilihan perlengkapan dan cendera mata bernuansa Islami dari Tanah Suci.',
                'items' => [
                    'Tasbih' => 'Tasbih dengan berbagai pilihan bahan, warna, dan model yang cocok sebagai oleh-oleh untuk keluarga maupun kerabat.',
                    'Sajadah' => 'Sajadah dengan beragam motif dan kualitas yang dapat dipilih sebagai buah tangan dari perjalanan ke Tanah Suci.',
                    'Parfum Non-Alkohol' => 'Pilihan parfum dan wewangian khas Timur Tengah yang populer sebagai oleh-oleh, dengan beragam aroma dan ukuran.',
                ],
            ],
            'produk-viral-populer' => [
                'title' => 'Produk Viral & Populer',
                'short_description' => 'Membantu mendapatkan berbagai produk yang sedang populer dan banyak dicari dari Arab Saudi.',
                'items' => [
                    'Camilan & Makanan Populer' => 'Berbagai camilan, makanan ringan, dan produk makanan populer yang dapat dititipkan sesuai ketersediaan dan ketentuan pengiriman.',
                    'Produk Khas Madinah' => 'Pilihan produk khas Madinah yang banyak diminati jamaah sebagai oleh-oleh dan buah tangan untuk keluarga di Indonesia.',
                    'Permintaan Khusus' => 'Layanan titip pembelian berdasarkan permintaan jamaah, selama barang tersedia dan memenuhi ketentuan yang berlaku untuk dibawa ataupun dikirim.',
                ],
            ],
        ];
    }

    public function up(): void
    {
        $cat = DB::table('categories')->where('slug', 'jastip-viral')->first();
        if (! $cat) {
            return;
        }

        DB::table('categories')->where('id', $cat->id)->update([
            'description' => '<p>' . $this->categoryDescription . '</p>',
        ]);

        // Hapus grup lama beserta itemnya (grup "Tumbler Tanah Suci" tidak ada di produksi).
        $oldIds = DB::table('services')->where('category_id', $cat->id)->pluck('id');
        DB::table('service_items')->whereIn('service_id', $oldIds)->delete();
        DB::table('services')->where('category_id', $cat->id)->delete();

        // Buat 3 grup + item sesuai produksi.
        foreach ($this->groups() as $slug => $g) {
            if (DB::table('services')->where('slug', $slug)->exists()) {
                $slug = $slug . '-jastip';
            }

            $serviceId = DB::table('services')->insertGetId([
                'category_id' => $cat->id,
                'title' => $g['title'],
                'slug' => $slug,
                'short_description' => $g['short_description'],
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $itemSort = 1;
            foreach ($g['items'] as $title => $desc) {
                DB::table('service_items')->insert([
                    'service_id' => $serviceId,
                    'title' => $title,
                    'slug' => app(\App\Services\SlugService::class)->make($title, 'service_items'),
                    'description' => '<p>' . $desc . '</p>',
                    'price_per_night' => 100,
                    'sort' => $itemSort,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $itemSort++;
            }
        }
    }

    public function down(): void
    {
        $cat = DB::table('categories')->where('slug', 'jastip-viral')->first();
        if (! $cat) {
            return;
        }

        $newSlugs = ['oleh-oleh-khas-arab-saudi', 'oleh-oleh-islami', 'produk-viral-populer'];
        $ids = DB::table('services')
            ->where('category_id', $cat->id)
            ->whereIn('slug', $newSlugs)
            ->pluck('id');
        DB::table('service_items')->whereIn('service_id', $ids)->delete();
        DB::table('services')->whereIn('id', $ids)->delete();

        DB::table('categories')->where('id', $cat->id)->update([
            'description' => '<p>' . $this->oldCategoryDescription . '</p>',
        ]);
    }
};
