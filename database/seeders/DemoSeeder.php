<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Banner;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $storedBanners = Storage::disk('public')->files('banners');
        $bannerImage = $storedBanners[0] ?? 'banners/placeholder.png';
        $fallbackImage = Storage::disk('public')->files('settings')[0] ?? 'settings/logo-duyufuna.jpg';

        $images = [
            $bannerImage,
            $fallbackImage,
            $bannerImage,
        ];

        Banner::updateOrCreate(
            ['title' => 'Perjalanan Umroh Bersama DUYUFUNA'],
            [
                'subtitle' => 'Layanan hotel, visa, transportasi, dan katering terbaik untuk jamaah umroh dan haji.',
                'image' => $bannerImage,
                'status' => true,
            ]
        );

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'about_title' => 'DUYUFUNA - Pelayanan Umroh & Haji Profesional',
                'about_banner' => $fallbackImage,
                'about_body' => '<p>DUYUFUNA melayani kebutuhan umroh dan haji Anda mulai dari hotel, visa, transportasi, handling bandara dan hotel, catering, hingga laundry dan layanan penunjang lainnya.</p><p>Kami berkomitmen memberikan pelayanan yang amanah, profesional, dan nyaman agar ibadah Anda berjalan lancar dan khusyuk.</p>',
            ]
        );

        $galleries = [
            ['title' => 'Masjidil Haram', 'description' => 'Kesempatan jamaah beribadah di Masjidil Haram, Mekkah.'],
            ['title' => 'Masjid Nabawi', 'description' => 'Kunjungan jamaah ke Masjid Nabawi, Madinah.'],
            ['title' => 'Hotel Jamaah', 'description' => 'Akomodasi hotel dengan akses mudah menuju area Haram.'],
        ];
        foreach ($galleries as $i => $g) {
            Gallery::updateOrCreate(
                ['title' => $g['title']],
                ['description' => $g['description'], 'image' => $images[$i % count($images)]]
            );
        }

        $testimonials = [
            ['name' => 'H. Ahmad Fauzi', 'review' => 'Pelayanan DUYUFUNA sangat memuaskan, hotel dan catering nya nyaman. Sangat direkomendasikan.', 'rating' => 5],
            ['name' => 'Ibu Siti Rahma', 'review' => 'Transportasi dan handling bandara lancar, tim ramah dan siap. Perjalanan ibadah kami jadi tenang.', 'rating' => 5],
            ['name' => 'Bp. Budi Santoso', 'review' => 'Proses visa dan pengurusan dokumen cepat dan jelas. Alhamdulillah puas beribadah ke Tanah Suci.', 'rating' => 4],
        ];
        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                ['review' => $t['review'], 'rating' => $t['rating'], 'status' => true]
            );
        }

        $faqs = [
            ['question' => 'Apakah paket DUYFUNA sudah termasuk visa dan hotel?', 'answer' => 'Ya, semua paket sudah mencakup visa, hotel, dan transportas i. Anda bisa menyesuaikan layanan sesuai kebutuhan.', 'sort' => 1],
            ['question' => 'Berapa lama proses pendaftaran dan visa?', 'answer' => 'Proses umumnya memakan waktu 2-5 minggu tergantung ketersediaan jadwal dan kelengkapan dokumen.', 'sort' => 2],
            ['question' => 'Apakah ada layanan khusus untuk jamaah lansia?', 'answer' => 'Tersedia layanan kursi roda umroh dan pendampingan khusus agar jamaah lansia tetap nyaman beribadah.', 'sort' => 3],
            ['question' => 'Bagaimana cara menghubungi customer service?', 'answer' => 'CS kami siap membantu 24 jam melalui WhatsApp. Klik tombol konsultasi gratis di halaman utama.', 'sort' => 4],
        ];
        foreach ($faqs as $f) {
            FAQ::updateOrCreate(
                ['question' => $f['question']],
                ['answer' => $f['answer'], 'sort' => $f['sort']]
            );
        }

        $articleCategoryId = optional(ArticleCategory::first())->id
            ?? ArticleCategory::firstOrCreate(['slug' => 'panduan-umroh'], ['name' => 'Panduan Umroh', 'sort' => 1])->id;

        $articles = [
            [
                'title' => 'Panduan Persiapan Umroh bagi Pemula',
                'slug' => 'panduan-persiapan-umroh-pemula',
                'excerpt' => 'Tips lengkap menyiapkan dokumen dan mental sebelum berangkat umroh.',
                'content' => '<p>Umroh merupakan perjalanan ibadah yang penuh berkah. Berikut hal yang perlu disiapkan agar ibadah Anda lancar.</p><h3>1. Siapkan Dokumen</h3><p>Paspor, visa, dan kelengkapan administrasi harus dipersiapkan sejak awal.</p><h3>2. Pahami Rangkaian Ibadah</h3><p>Pelajari urutan tahram, thawaf, sai, dan tahallul.</p><h3>3. Jaga Kondisi Fisik</h3><p>Konsumsi makanan sehat dan cukup istirahat selama perjalanan.</p>',
            ],
            [
                'title' => 'Tips Memilih Hotel Dekat Masjidil Haram',
                'slug' => 'tips-memilih-hotel-dekat-masjidil-haram',
                'excerpt' => 'Panduan memilih akomodasi terbaik yang dekat dan nyaman bagi jamaah umroh.',
                'content' => '<p>Kedekatan jarak hotel dengan Masjidil Haram menjadi faktor utama kenyamanan jamaah.</p><p>Pilih hotel dengan akses mudah dan fasilitas lengkap. DUYUFUNA memiliki pilihan hotel terbaik di area Haram.</p>',
            ],
        ];
        foreach ($articles as $a) {
            Article::updateOrCreate(
                ['slug' => $a['slug']],
                [
                    'title' => $a['title'],
                    'article_category_id' => $articleCategoryId,
                    'excerpt' => $a['excerpt'],
                    'content' => $a['content'],
                    'status' => true,
                    'published_at' => now(),
                ]
            );
        }
    }
}