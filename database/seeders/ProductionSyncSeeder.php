<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Menyamakan konten database lokal dengan website produksi
 * (https://duyufuna.com) — hasil panen 14 Sep 2026.
 *
 * Prasyarat: aset gambar sudah diunduh agar path valid:
 *   bash scripts/fetch-production-images.sh
 *
 * Penyimpangan disengaja dari produksi (perbaikan yang akan dideploy):
 * 1. map_link hotel Madinah dibiarkan NULL sehingga ServiceItem::mapUrl()
 *    menunjuk Masjid Nabawi (produksi masih salah ke Masjid al-Haram).
 * 2. Teks yang menyebut Jeddah dibersihkan (layanan hotel kini Mekkah + Madinah).
 */
class ProductionSyncSeeder extends Seeder
{
    public function run(): void
    {
        $this->syncSettings();
        $this->syncBanners();
        $this->syncFaqs();
        $this->syncTestimonials();
        $this->syncGalleries();
        $this->syncArticles();

        $this->syncHotels();
        $this->syncVisa();
        $this->syncTransportasi();
        $this->syncCatering();
        $this->syncHandling();
        $this->syncLaundry();
        $this->syncBuggy();
        $this->syncKursiRoda();
        $this->syncMuthawif();
        $this->syncPenukaran();
        $this->syncJastip();
        $this->syncFotografer();

        $this->command?->info('ProductionSyncSeeder: konten lokal disamakan dengan produksi.');
    }

    // ---------------------------------------------------------------- Helpers

    protected function category(string $slug): Category
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    protected function service(Category $category, string $slug, array $attrs): Service
    {
        return Service::updateOrCreate(
            ['category_id' => $category->id, 'slug' => $slug],
            array_merge(['status' => true], $attrs)
        );
    }

    protected function dropServices(Category $category): void
    {
        $ids = Service::where('category_id', $category->id)->pluck('id');
        ServiceItem::whereIn('service_id', $ids)->delete();
        Service::where('category_id', $category->id)->delete();
    }

    protected function replaceItems(Service $service, array $rows): void
    {
        ServiceItem::where('service_id', $service->id)->delete();

        foreach ($rows as $i => $row) {
            // Cover kartu = foto pertama galeri bila image tidak diisi
            // (item hotel hanya punya gallery; produksi menampilkan foto
            // pertama sebagai cover kartu).
            if (empty($row['image']) && !empty($row['gallery'][0]) && is_string($row['gallery'][0])) {
                $row['image'] = $row['gallery'][0];
            }
            ServiceItem::create(array_merge($row, [
                'service_id' => $service->id,
                'sort' => $i + 1,
                'status' => true,
            ]));
        }
    }

    // ------------------------------------------------------------- Settings

    protected function syncSettings(): void
    {
        $setting = Setting::findOrFail(1);

        $setting->fill([
            'address' => 'Jepara, Indonesia',
            'wa_message' => "Assalamu'alaikum,\nSaya ingin berkonsultasi.",
            'footer_text' => 'Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.',
            'logo' => 'settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp',
            'about_image' => 'settings/Hb985l3DWV3dUoHMM1cYnavXuErjEStvdzK3KSKW.webp',

            'seo_description' => 'Platform layanan umroh, haji, hotel, dan transportasi di tanah suci. Mudah, amanah, berkah.',
            'seo_keywords' => 'umroh, haji, travel umroh, hotel mekkah, hotel madinah',

            'og_title' => 'DUYUFUNA',
            'og_description' => 'Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.',
            'og_image' => 'settings/o4uUxGyBLqVgbMJPTppnp20VeyQmy37iUDlpp0B9.webp',
            'og_type' => 'website',
            'og_site_name' => 'DUYUFUNA',

            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'DUYUFUNA',
            'twitter_description' => 'MELAYANI TAMU ALLAH, SEPENUH HATI',

            'greeting_title' => "Assalamu'alaikum",
            'greeting_subtitle' => 'Selamat datang di Duyufuna',
            'greeting_text' => 'Temukan berbagai layanan umroh dan haji untuk menemani perjalanan ibadah Anda dengan lebih mudah, nyaman, dan tenang menuju Tanah Suci.',
            'greeting_image' => 'settings/aDkXS8czm0NiRg7UBZ7XhbgNkygLpl1g0xDMDrVN.webp',

            'why_label' => 'Mengapa Kami',
            'why_title' => 'Kenapa Memilih <span class="text-gradient-gold">DUYUFUNA</span> ?',
            'why_subtitle' => 'Kami berkomitmen memberikan layanan terbaik untuk perjalanan umroh Anda',

            'testimonial_label' => 'Testimonial',
            'testimonial_title' => 'Apa Kata <span class="text-dark-green">Jamaah</span> ?',
            'testimonial_subtitle' => 'Pengalaman nyata dari jamaah yang telah menggunakan layanan kami',

            'about_title' => 'Tentang Kami',
            'about_body' => implode("\n\n", [
                'Duyufuna hadir sebagai penyedia layanan umroh dan haji yang berkomitmen membantu memenuhi berbagai kebutuhan perjalanan jamaah menuju Tanah Suci. Kami memahami bahwa perjalanan ibadah bukan sekadar perjalanan biasa, tetapi sebuah perjalanan yang membutuhkan persiapan, ketelitian, kenyamanan, dan pelayanan yang baik sejak sebelum keberangkatan hingga jamaah kembali ke tanah air.',
                'Melalui berbagai layanan yang terintegrasi, kami menyediakan kebutuhan pendukung perjalanan seperti pengurusan visa, akomodasi hotel di Mekkah dan Madinah, transportasi, handling bandara, handling hotel, catering, laundry, serta berbagai kebutuhan lainnya. Setiap layanan disiapkan untuk membantu jamaah maupun penyelenggara perjalanan mendapatkan solusi yang lebih praktis dan terkoordinasi.',
                'Kami terus berupaya menghadirkan pelayanan yang responsif, fleksibel, dan berorientasi pada kebutuhan jamaah. Dengan memahami bahwa setiap rombongan memiliki kebutuhan yang berbeda, layanan dapat disesuaikan berdasarkan jumlah jamaah, jadwal perjalanan, pilihan akomodasi, serta kebutuhan khusus lainnya.',
                '## Visi',
                'Menjadi penyedia layanan umroh dan haji yang terpercaya dan profesional dalam menghadirkan kemudahan, kenyamanan, serta layanan pendukung perjalanan ibadah yang berkualitas bagi setiap jamaah.',
                '## Misi',
                "1. Menyediakan berbagai layanan pendukung perjalanan umroh dan haji secara lengkap dan terintegrasi.\n2. Memberikan pelayanan yang mudah, responsif, dan sesuai dengan kebutuhan jamaah.\n3. Mengutamakan kenyamanan, ketepatan, dan kualitas dalam setiap layanan.\n4. Membangun kerja sama yang baik dengan berbagai pihak untuk mendukung kelancaran perjalanan jamaah.\n5. Terus meningkatkan kualitas layanan dan mengikuti perkembangan kebutuhan perjalanan ibadah.\n6. Membantu menciptakan perjalanan menuju Tanah Suci yang lebih tertata, nyaman, dan tenang bagi jamaah.",
            ]),
        ])->save();
    }

    protected function syncBanners(): void
    {
        Banner::query()->delete();

        foreach ([
            'banners/habByeocLVPiKiaVy8irEq76j3OvReK3GYomRr6m.webp',
            'banners/RF2HZi3D9GCfUUj9CWY9xFxAnw4GLyfwgFOQJvlV.webp',
            'banners/jyatSoQNDf3bwPmIzmGZCBlWRK0OpsOL08lqS6TJ.webp',
        ] as $i => $image) {
            Banner::create([
                'image' => $image,
                'status' => true,
                'sort' => $i + 1,
            ]);
        }
    }

    // ------------------------------------------------------------------ FAQ

    protected function syncFaqs(): void
    {
        Faq::query()->delete();

        $faqs = [
            // Jawaban #1 produksi masih menyebut Jeddah — dibersihkan (fokus Mekkah & Madinah).
            ['Apa saja layanan yang disediakan Duyufuna?', 'Duyufuna menyediakan berbagai kebutuhan perjalanan ibadah umroh dan haji, mulai dari akomodasi hotel di Mekkah dan Madinah, transportasi, visa, handling bandara, catering, laundry, hingga berbagai layanan pendukung jamaah selama berada di Tanah Suci.'],
            ['Apakah paket DUYFUNA sudah termasuk visa dan hotel?', 'Ya, semua paket sudah mencakup visa, hotel, dan transportas i. Anda bisa menyesuaikan layanan sesuai kebutuhan.'],
            ['Apakah Duyufuna melayani jamaah individu dan rombongan?`', 'Ya. Layanan Duyufuna dapat disesuaikan untuk jamaah individu, keluarga, maupun rombongan dalam jumlah besar. Kebutuhan akomodasi, transportasi, dan layanan lainnya dapat disesuaikan dengan itinerary dan kebutuhan perjalanan'],
            ['Berapa lama proses pendaftaran dan visa?', 'Proses umumnya memakan waktu 2-5 minggu tergantung ketersediaan jadwal dan kelengkapan dokumen.'],
            ['Apakah Duyufuna melayani jamaah umroh dan haji?', 'Duyufuna menyediakan layanan yang mendukung perjalanan umroh maupun haji. Jenis layanan dan ketersediaannya dapat disesuaikan dengan periode perjalanan serta ketentuan yang berlaku.'],
            ['Apakah ada layanan khusus untuk jamaah lansia?', 'Tersedia layanan kursi roda umroh dan pendampingan khusus agar jamaah lansia tetap nyaman beribadah.'],
            ['Apakah transportasi dapat disediakan untuk rombongan besar?', 'Bisa. Armada dan jenis kendaraan dapat disesuaikan dengan jumlah jamaah serta rute perjalanan yang dibutuhkan.'],
            ['Bagaimana cara menghubungi customer service?', 'CS kami siap membantu 24 jam melalui WhatsApp. Klik tombol konsultasi gratis di halaman utama.'],
        ];

        foreach ($faqs as $i => [$question, $answer]) {
            Faq::create([
                'question' => $question,
                'answer' => $answer,
                'sort' => $i + 1,
                'status' => true,
            ]);
        }
    }

    // ---------------------------------------------------------- Testimonials

    protected function syncTestimonials(): void
    {
        Testimonial::query()->delete();

        // Produksi menampilkan 5 screenshot chat (tanpa nama/teks ulasan).
        $images = [
            'testimonials/twGrsH3tdPZOSjKBSXEoZFYurE8bY7HPDaGSp4di.webp',
            'testimonials/5HTvSGTjclDfgVFLwcUoxH1I73XDpYhdqHEDl66c.webp',
            'testimonials/azhsGhcKIllP3iFSml3ZapWQL3PFa5WCwtRoSTx1.webp',
            'testimonials/9loPaexAtZclpLSpWxViOZDGhRaoeifmwgL9IxXU.webp',
            'testimonials/U4kDMs3fpMRwFaQWu1O7Ajf5tSPjTHIZvTA2y3W1.webp',
        ];

        foreach ($images as $image) {
            Testimonial::create([
                'name' => '',
                'review' => '',
                'rating' => 5,
                'image' => $image,
                'status' => true,
            ]);
        }
    }

    // -------------------------------------------------------------- Galleries

    protected function syncGalleries(): void
    {
        Gallery::query()->delete();

        $items = [
            ['Suasana Jamaah Haji di Mina', 'galleries/t1T7n5B3EBi2cMhT3JlTu6NISMu5V1nZYnCipkZJ.jpeg'],
            ['Jamaah di Pelataran Masjid Nabawi', 'galleries/g7N3SehFq2G6NUOKLBgXISuDkTJebHK4xQG9X4zb.jpeg'],
            ['Jamaah Tiba di Jeddah', 'galleries/Cdzycq0UehRLfgkFnWR5x3bZYS3JfkzSUDM3xTWO.jpeg'],
            ['Jamaah di Arafah - Haji', 'galleries/7yK00hWFFwzzoQJXyxaQMXtXgv3ZYJIJcPZmjzHm.jpg'],
            ['Jamaah Melaksanakan Tawaf', 'galleries/pIHZfQFpKyHoSJ2eruDGCFFHtXDnql2hj2IrcuD3.jpeg'],
            ['Jamaah di Masjid Nabawi - Madinah', 'galleries/lzLJYxJv9xmqpScSOedKFeyaQ8HMQHM32FdX2g6h.jpg'],
            ['Suasana Jamaah di Masjidil Haram - Mekkah', 'galleries/TrUlqlamR5ygOqK8pPoAk6ZOXJY68Y5464siasol.jpeg'],
        ];

        foreach ($items as $i => [$title, $image]) {
            Gallery::create(['title' => $title, 'image' => $image]);
        }
    }

    // -------------------------------------------------------------- Articles

    protected function syncArticles(): void
    {
        ArticleCategory::firstOrCreate(
            ['slug' => 'seputar-madinah'],
            ['name' => 'Seputar Madinah', 'sort' => 6, 'status' => true]
        );
        ArticleCategory::firstOrCreate(
            ['slug' => 'seputar-haji'],
            ['name' => 'Seputar Haji', 'sort' => 7, 'status' => true]
        );

        $cat = fn (string $slug): ArticleCategory => ArticleCategory::where('slug', $slug)->firstOrFail();

        $articles = [
            [
                'slug' => 'mengenal-perjalanan-haji',
                'title' => 'Mengenal Perjalanan Haji',
                'category' => $cat('seputar-haji'),
                'excerpt' => 'Dari Arafah, Muzdalifah hingga Mina',
                'image' => 'articles/RnvHgLs9NecUEPXMkxo0oWq1oixmtCOKm5HKVXjW.jpeg',
                'views' => 32,
                'content' => [
                    'Ibadah haji memiliki rangkaian perjalanan yang berbeda dengan umroh. Salah satu bagian terpentingnya adalah perjalanan jamaah menuju Arafah, Muzdalifah, dan Mina yang berlangsung dalam rangkaian waktu dan ketentuan tertentu. Arafah menjadi salah satu tempat yang sangat penting dalam pelaksanaan haji, kemudian jamaah melanjutkan perjalanan menuju Muzdalifah dan Mina sesuai dengan rangkaian manasik yang telah ditetapkan.',
                    'Di Mina, jamaah melaksanakan rangkaian ibadah termasuk melempar jumrah. Setelah Iduladha, jamaah memasuki hari-hari Tasyrik yang berlangsung pada 11, 12, dan 13 Zulhijah. Kementerian Haji dan Umrah menjelaskan bahwa hari-hari tersebut merupakan bagian penting dari rangkaian akhir ibadah haji, sekaligus menjadi waktu bagi jamaah untuk terus memperbanyak zikir.',
                    'Pelaksanaan haji juga membutuhkan kepatuhan terhadap prosedur resmi. Pemerintah Arab Saudi menegaskan bahwa pelaksanaan haji harus melalui jalur dan izin resmi. Ketentuan tersebut diterapkan untuk menjaga keamanan jamaah, mengatur kepadatan, serta memastikan layanan transportasi dan fasilitas di tempat-tempat suci dapat berjalan secara terorganisir.',
                    'Karena rangkaian haji memiliki banyak tahapan dan kondisi lapangan yang berbeda, jamaah sangat dianjurkan mengikuti arahan pembimbing dan penyelenggara resmi. Persiapan fisik, pemahaman manasik, serta kemampuan mengikuti jadwal perjalanan menjadi bagian penting agar seluruh rangkaian ibadah dapat dijalani dengan tertib dan nyaman.',
                ],
            ],
            [
                'slug' => 'mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh',
                'title' => 'Mengapa Madinah Menjadi Bagian Penting dalam Perjalanan Umroh?',
                'category' => $cat('seputar-madinah'),
                'excerpt' => null,
                'image' => 'articles/Or2B5A7pOdrBngKW268UPlMfplbPT2zZNCVj6pMY.jpeg',
                'views' => 14,
                'content' => [
                    'Madinah memiliki tempat yang sangat istimewa dalam perjalanan spiritual umat Islam. Di kota inilah terdapat Masjid Nabawi, salah satu masjid yang memiliki kedudukan utama dalam Islam. Bagi banyak jamaah umroh, perjalanan ke Madinah menjadi kesempatan untuk memperbanyak ibadah, mengunjungi Masjid Nabawi, serta mengenal lebih dekat sejarah Rasulullah SAW dan para sahabat.',
                    'Selama berada di Madinah, jamaah biasanya memiliki kesempatan untuk mengunjungi sejumlah tempat bersejarah seperti Masjid Quba, Masjid Qiblatain, kawasan Uhud, dan berbagai lokasi yang berkaitan dengan sejarah perkembangan Islam. Kementerian Haji dan Umrah Arab Saudi juga menyediakan panduan khusus mengenai landmark Makkah dan Madinah serta layanan yang tersedia di Masjid Nabawi.',
                    'Pemilihan hotel juga menjadi bagian penting. Hotel yang berada di kawasan pusat Madinah atau dekat Masjid Nabawi dapat memberikan kemudahan bagi jamaah untuk pergi dan kembali ke hotel tanpa perjalanan yang terlalu jauh. Hal ini sangat membantu terutama bagi jamaah lansia dan keluarga.',
                    'Lebih dari sekadar persinggahan, Madinah dapat menjadi bagian perjalanan yang memberikan ketenangan dan kesempatan bagi jamaah untuk memperbanyak ibadah serta mengenang perjuangan Rasulullah SAW dalam membangun masyarakat Islam.',
                ],
            ],
            [
                'slug' => 'panduan-persiapan-umroh',
                'title' => 'Panduan Persiapan Umroh',
                'category' => $cat('panduan-umroh'),
                'excerpt' => 'Hal Penting yang Perlu Disiapkan Sebelum Berangkat',
                'image' => 'articles/wX70HQSuCcZDoU3Uxl856OAptw5ldS8ahT0OMCb8.jpeg',
                'views' => 14,
                'content' => [
                    'Menunaikan ibadah umroh merupakan perjalanan yang membutuhkan persiapan, bukan hanya secara fisik tetapi juga dari sisi administrasi, perlengkapan, pengetahuan ibadah, dan kesiapan mental. Persiapan yang baik akan membantu jamaah menjalani perjalanan dengan lebih tenang sejak keberangkatan hingga kembali ke tanah air.',
                    'Sebelum berangkat, jamaah perlu memastikan dokumen perjalanan, visa, tiket, akomodasi, transportasi, serta perlengkapan pribadi telah dipersiapkan dengan baik. Selain itu, penting untuk memahami kembali tata cara ihram, tawaf, sa\'i, dan tahallul agar pelaksanaan ibadah dapat dilakukan dengan benar. Kementerian Haji dan Umrah Arab Saudi juga menyediakan Umrah and Visit Guide yang membahas perjalanan jamaah mulai dari persiapan sebelum keberangkatan, prosedur visa, ihram, pelaksanaan manasik, perjalanan antarlokasi, hingga kepulangan. Panduan tersebut tersedia dalam 16 bahasa.',
                    'Jamaah juga sebaiknya mempersiapkan kondisi fisik, membawa obat-obatan pribadi jika diperlukan, menggunakan pakaian dan alas kaki yang nyaman, serta tidak membawa barang secara berlebihan. Dengan persiapan yang matang, perjalanan menuju Tanah Suci dapat dijalani dengan lebih nyaman dan jamaah dapat lebih fokus pada tujuan utama, yaitu beribadah.',
                ],
            ],
            [
                'slug' => 'memilih-hotel-di-mekkah',
                'title' => 'Memilih Hotel di Mekkah',
                'category' => $cat('tips-perjalanan'),
                'excerpt' => 'Dekat Masjidil Haram atau Lebih Ekonomis?',
                'image' => 'articles/oJCGOjv1UT7dvkxTFNbVjIH3I6Nq6sDaa96gB5YQ.jpeg',
                'views' => 11,
                'content' => [
                    'Pemilihan hotel menjadi salah satu hal yang perlu diperhatikan ketika merencanakan perjalanan umroh. Di Mekkah, perbedaan lokasi hotel dapat memberikan pengalaman yang cukup berbeda bagi jamaah. Hotel yang berada dekat Masjidil Haram biasanya memberikan kemudahan akses untuk melaksanakan shalat dan ibadah lainnya, tetapi umumnya memiliki harga yang lebih tinggi dibandingkan hotel yang berada lebih jauh.',
                    'Bagi jamaah lansia, keluarga dengan anak-anak, atau jamaah yang memiliki keterbatasan dalam berjalan jauh, hotel yang dekat dengan Masjidil Haram dapat menjadi pilihan yang lebih nyaman. Sementara itu, jamaah yang ingin menekan biaya perjalanan dapat mempertimbangkan hotel yang lokasinya sedikit lebih jauh dengan fasilitas transportasi yang memadai.',
                    'Selain jarak, jangan lupa memperhatikan akses masuk dan keluar hotel, kapasitas lift, fasilitas restoran, layanan transportasi, ukuran kamar, serta kondisi lingkungan sekitar. Pada musim ramai, jarak yang terlihat dekat di peta belum tentu terasa sama ketika kawasan sekitar Masjidil Haram dipenuhi jamaah.',
                    'Karena itu, hotel terbaik bukan selalu hotel yang paling mahal, melainkan hotel yang paling sesuai dengan kebutuhan dan kondisi jamaah. Duyufuna dapat membantu jamaah memilih akomodasi berdasarkan kebutuhan perjalanan, tingkat kenyamanan, serta anggaran yang tersedia.',
                ],
            ],
        ];

        foreach ($articles as $row) {
            $article = Article::updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'excerpt' => $row['excerpt'],
                    'image' => $row['image'] ?? null,
                    'content' => implode("\n\n", array_map(fn ($p) => '<p>' . $p . '</p>', $row['content'])),
                    'article_category_id' => $row['category']->id,
                    'published_at' => '2026-08-07 07:00:00',
                    'status' => true,
                ]
            );
            $article->forceFill(['views' => $row['views']])->save();
        }
    }

    // ---------------------------------------------------------------- Hotels

    protected function syncHotels(): void
    {
        $category = $this->category('hotel');
        $category->update(['page_type' => 'catalog', 'group_label' => 'Kota', 'item_label' => 'Hotel']);

        // Slug mengikuti produksi: /service/mekkah & /service/madinah.
        // Duplikat lama hotel-mekkah / hotel-madinah (0 item) dihapus agar
        // tidak muncul sebagai grup kosong.
        Service::where('category_id', $category->id)
            ->whereIn('slug', ['hotel-mekkah', 'hotel-madinah'])
            ->delete();
        $mekkah = $this->service($category, 'mekkah', [
            'title' => 'Mekkah',
            'short_description' => 'Rekomendasi hotel untuk jamaah umroh di area Masjidil Haram',
            'image' => 'services/KamntboD66qClN4oQPpSg2Miut9dr9L8m1jL2quQ.jpg',
        ]);
        $madinah = $this->service($category, 'madinah', [
            'title' => 'Madinah',
            'short_description' => 'Rekomendasi hotel untuk jamaah umroh di area Masjid Nabawi',
            'image' => 'services/OA4Aci4lNwexvir8JqX1wSSh8SjC4nCHVJMOry1X.jpg',
        ]);

        $this->replaceItems($mekkah, $this->hotelMekkah());
        $this->replaceItems($madinah, $this->hotelMadinah());
    }

    protected function hotelMekkah(): array
    {
        $g = fn (string ...$files) => array_map(fn ($f) => 'service-items/' . $f, $files);

        return [
            [
                'slug' => 'maysan-al-mawom', 'title' => 'Maysan Al Mawom',
                'area' => 'Ajyad', 'distance' => '± 550 meter', 'walk_time' => '8-10 menit',
                'room_types' => 'Double (2 orang), Triple (3 orang), Quad (4 orang)',
                'price_per_night' => 200, 'price_max' => 300,
                'description' => '<p>Cocok untuk jamaah yang mengutamakan harga terjangkau. Berada di kawasan Ajyad yang ramai dan mudah mencari kebutuhan harian. Pilihan ekonomis dengan kualitas yang baik. Akses kendaraan cukup mudah saat keberangkatan ziarah.</p>',
                'benefit' => "Cocok untuk jamaah yang mengutamakan harga terjangkau.\nBerada di kawasan Ajyad yang ramai dan mudah mencari kebutuhan harian.\nPilihan ekonomis dengan kualitas yang baik.\nAkses kendaraan cukup mudah saat keberangkatan ziarah.",
                'recommendation' => 'Rekomendasi untuk Jamaah reguler yang menginginkan keseimbangan antara biaya dan kenyamanan.',
                'gallery' => $g('00akaUGZqtJT75ktCnC9Vz533MwAlZfXv9aqnVHm.jpg', 'Vp6O8abjkbfQlTmE3EYiLSpnzQNhTNs9JbHEguAv.jpg', 'yJuVflIBkTDeEFhd6ThJKDnVvmWwu3nld4WCyCSX.jpg', 'hNKi0pwXrgqRZGey9pRSPokFXbH72sduk86TAzIa.jpg', 'YXMXqPWVGy7HxAhdWcrQXbtQTboDeUPaAlo3gOIZ.jpg'),
            ],
            [
                'slug' => 'grand-al-massa', 'title' => 'GRAND AL MASSA',
                'area' => 'Ajyad', 'distance' => '± 700 meter', 'walk_time' => '11-13 menit',
                'room_types' => 'Double, Triple, Quad',
                'benefit' => "Banyak pilihan restoran dan minimarket di sekitar hotel.\nLokasi lebih dekat dibanding sebagian besar hotel bintang 3.\nSalah satu hotel favorit jamaah Indonesia.\nKualitas kamar cukup baik untuk kategori ekonomis.",
                'recommendation' => 'Rekomendasi untuk Jamaah yang ingin mendapatkan lokasi lebih dekat dengan harga yang masih terjangkau.',
                'gallery' => $g('dOIfDd2X2G9TBk2tqccut4m6RZZXveAUa43fUHwg.jpg', '727Nsu4g9gieruZIHaWVrPDeg5Vol4AuBpYzX8Ag.jpg', 'D3F19zzzi46Vgs2oasVDkoZfqTVg6N9UJ6MUD0Y5.jpg'),
            ],
            [
                'slug' => 'azka-safa', 'title' => 'AZKA SAFA',
                'area' => 'Ajyad', 'distance' => '± 400 meter', 'walk_time' => '6-8 menit',
                'room_types' => 'Double, Triple, Quad',
                'benefit' => "Lokasi sangat strategis.\nCocok untuk jamaah yang ingin kenyamanan lebih tanpa biaya hotel premium.\nAkses menuju Masjidil Haram relatif mudah.\nKualitas kamar dan fasilitas di atas hotel bintang 3.",
                'recommendation' => 'Rekomendasi untuk Jamaah keluarga dan lansia yang menginginkan jarak dekat dengan biaya yang masih efisien.',
                'gallery' => $g('dI6CKhdTLcqpZypCmfe9KLhABMV8FsM0S58rO2gf.jpg', 'R8LVmZHdKaP1jNw1rgDYF2tn9cnpGmAK7sbjX11c.jpg', 'cBnDgb5XgyaSljcXrYISEgM23dfjEmwchcqkusVX.jpg', 'OaYHJpn9Lja37ulZmJpJ7Lb6UkItVhaFKQksgRJE.jpg'),
            ],
            [
                'slug' => 'maysan-mashaer', 'title' => 'MAYSAN MASHAER',
                'area' => 'Ajyad', 'distance' => '± 500 meter', 'walk_time' => '7-9 menit',
                'room_types' => 'Double, Triple, Quad',
                'benefit' => "Lingkungan hotel cukup tenang.\nCocok untuk jamaah keluarga maupun lansia.\nBangunan relatif modern.\nKamar nyaman dan tertata baik.",
                'recommendation' => 'Rekomendasi untuk Jamaah yang mengutamakan kenyamanan kamar dan suasana yang cukup tenang.',
                'gallery' => $g('E4DNvUM5jMPzSQRbBHA7q772msufsqKpGJGfwVsa.jpg', 'Duq2jsD9RRxKxIxHnbAl2a1UUMd24A5Z5SVZo9q5.jpg', 'LtwjR3FBghhyr24ImtILk00fK1zwatZE791YpiEr.jpg', 'nI0w83XidyES7pXjvRePdXUS8aEc4m1xMVbgDwme.jpg'),
            ],
            [
                'slug' => 'safwah-tower-34', 'title' => 'SAFWAH TOWER 3/4',
                'area' => 'Kompleks Abraj Al Bait', 'distance' => '+50-100 meter', 'walk_time' => '2-3 menit',
                'room_types' => 'Double, Triple, Junior Suite, Suite',
                'benefit' => "Memudahkan jamaah untuk kembali ke kamar saat waktu istirahat.\nTerhubung langsung dengan pusat perbelanjaan dan food court.\nSangat nyaman bagi lansia dan pengguna kursi roda.\nSalah satu hotel terdekat dengan Masjidil Haram.",
                'gallery' => $g('u16G6Xs319fPwM8fHJ7UFK5oTXZocHXaThUAAGRX.jpg', '58Flq7BIlwXdxHdVFe1BqLA6j0zNhgBcD9v14yEI.jpg', 'GNtWq11InPMINXRRn91XFkkLE3SFLNet8G61C0KU.jpg', 's8nZpbIlIKTvvoAZEpQ1CFn0FudeZl5WPvkmHlGo.jpg'),
            ],
            [
                'slug' => 'pullman-zam-zam-makkah', 'title' => 'PULLMAN ZAM ZAM MAKKAH',
                'area' => 'Abraj Al Bait', 'distance' => '+100-150 meter', 'walk_time' => '2-4 menit',
                'room_types' => 'Double, Triple, Family Room, Suite',
                'benefit' => "Sebagian kamar memiliki pemandangan Masjidil Haram.\nPelayanan hotel berstandar internasional.\nSangat cocok untuk keluarga.\nBrand internasional premium.\nKamar luas dan elegan.",
                'gallery' => $g('zM6L1Xve1iPc62sxMXHz1ayMz8l26e2KBGLwJDa6.jpg', '4XfbNRrhiqD7JwYK0WDe3tJgaTxZVRr5kWaSFZCQ.jpg', 'NOFZXiijTIi9n8slgjKUmxss3piuWcXZCasdje6w.jpg'),
            ],
        ];
    }

    protected function hotelMadinah(): array
    {
        $g = fn (string ...$files) => array_map(fn ($f) => 'service-items/' . $f, $files);

        return [
            [
                'slug' => 'odst-al-madinah', 'title' => 'ODST AL MADINAH',
                'area' => 'Markaziyah Utara (Ring 2 Masjid Nabawi)', 'distance' => '+250-350 meter', 'walk_time' => '3-5 menit',
                'room_types' => 'Double, Triple, Quad',
                'description' => '<p>Hotel ODST Al Madinah adalah hotel populer di Kota Madinah, Arab Saudi, yang sangat diminati oleh jemaah umrah dan haji asal Indonesia</p>',
                'benefit' => "Cocok untuk paket umroh ekonomis dengan lokasi yang masih nyaman.\nArea relatif ramai dan mudah untuk mencari kebutuhan harian jamaah.\nSalah satu hotel favorit jamaah Indonesia.\nLokasi cukup dekat dengan area Masjid Nabawi.\nBanyak toko, minimarket, dan restoran di sekitar hotel.",
                'recommendation' => 'Rekomendasi untuk Jamaah yang mengutamakan harga ekonomis namun tetap dekat dengan Masjid Nabawi.',
                'gallery' => $g('imf2ops4CuIOyEvJkRWEtTNN4pDbuQyR7hgx6Ved.jpg', 'n10SdJHQmCmXw8ATVkOA6VHpR2ntZb2f4simujBE.jpg', '4A1YWCA36DdX4l29C8RMTxckOb82JpVN7xZWgFAm.jpg', 'HiYjToxFIWfGLjPyPm3wzgReiRphBgvmVSr7sgHs.jpg'),
            ],
            [
                'slug' => 'concorde-dar-al-khair', 'title' => 'CONCORDE DAR AL KHAIR',
                'area' => 'Markaziyah Utara', 'distance' => '+100-150 meter', 'walk_time' => '2-3 menit',
                'room_types' => 'Double, Triple, Quad',
                'benefit' => "Dekat akses menuju Gate 326 dan area shalat wanita.\nNilai terbaik untuk kategori hotel bintang 3 premium.\nSangat dekat dengan area Masjid Nabawi.\nKamar relatif luas dibanding hotel sekelasnya.\nBanyak digunakan oleh travel Indonesia.",
                'gallery' => $g('wzj0LyjyP0k84WBMAu5L3pOAP6SDKKiGWH5Dlmbi.jpg', '8SKnIRBCglP27zTgAe0bbgWtamFTyCXtBkP2uJh4.jpg', 'M1cDzR6IxBUsINxogOkBzI0CQJZeHQqu6auPlnZF.jpg', 'isSOOl4r9reWNwCi3usJT6OVv6B21mXpRZ3CMmIn.jpg'),
            ],
            [
                'slug' => 'nozol-royal-inn', 'title' => 'NOZOL ROYAL INN',
                'area' => 'Markaziyah', 'distance' => '+150-250 meter', 'walk_time' => '2-4 menit',
                'room_types' => 'Double, Triple, Quad, Suite',
                'benefit' => "Akses mudah menuju area pelataran Masjid Nabawi.\nSalah satu hotel bintang 4 yang paling dikenal di kawasan Markaziyah.\nLokasi sangat strategis.\nLobby dan fasilitas hotel cukup representatif.\nCocok untuk rombongan dan keluarga.",
                'recommendation' => 'Rekomendasi untuk Jamaah yang menginginkan kenyamanan lebih dengan lokasi yang dekat.',
                'gallery' => $g('AsqlB4HLL2VT1BzUMU6KyLQxXe6YTsmPaFHEKTNh.jpg', 'eon2RQl2DTDbqxmWaqU4IJwoHL2D9uL2r4PquPi3.jpg', 'Qscwi7p3EfNfIsBjVMCuNqws5Kx2CaxhcWtonL4Y.jpg'),
            ],
            [
                'slug' => 'al-ansor-golden-tulip', 'title' => 'AL ANSOR GOLDEN TULIP',
                'area' => 'Markaziyah Utara', 'distance' => '+150-250 meter', 'walk_time' => '2-4 menit',
                'room_types' => 'Double, Triple, Quad',
                'benefit' => "Banyak pilihan kuliner dan toko oleh-oleh di sekitar hotel.\nSalah satu hotel yang cukup populer di kalangan jamaah Indonesia.\nLokasi strategis untuk akses ibadah.\nSalah satu hotel yang memiliki loby luas dan lift banyak.",
                'recommendation' => 'Rekomendasi untuk Jamaah keluarga dan lansia yang membutuhkan akses mudah ke Masjid Nabawi.',
                'gallery' => $g('6VM84CgIWAE5AO68eqo1IaC7h30lcSjO4VftHUu5.jpg', 'kHZJsB0tuOhksVBBfjIh1VaWDNCdgPhT0c7S8skj.jpg', 'rR4x1f8o5WfiKeWoluefk4bXURDNpIKIvwTNoV2Q.jpg', 'NlPIAeD3UFujmJmNgxhV8ewxXaUGZmYHo338jv3T.jpg'),
            ],
            [
                'slug' => 'el-haram-hotel', 'title' => 'EL-HARAM HOTEL',
                'area' => 'Ring 1 Masjid Nabawi', 'distance' => '+50-100 meter', 'walk_time' => '1-2 menit',
                'room_types' => 'Double, Triple, Suite',
                'benefit' => "Berada di area premium sekitar pelataran Masjid Nabawi.\nMemudahkan jamaah kembali ke kamar untuk beristirahat.\nSangat dekat dengan area ibadah.\nSangat ideal bagi lansia dan pengguna kursi roda.",
                'recommendation' => 'Rekomendasi untuk Jamaah VIP, lansia, dan keluarga yang mengutamakan kedekatan dengan masjid.',
                'gallery' => $g('6jZEL6FjvsdnbVwZMH6eKVZT3e7oq8copqjyaDuI.jpg', 'tIKZ05nHkZT4u4uUnSGBkVI07ZEcTgPf4lQPtg2r.jpg', 'doCCuMW7CLenTouavpfMpOE6xMDJ3xCpdT3cvkIj.jpg'),
            ],
            [
                'slug' => 'maden-hotel', 'title' => 'MADEN HOTEL',
                'area' => 'Markaziyah', 'distance' => '+150-250 meter', 'walk_time' => '2-4 menit',
                'room_types' => 'Double, Triple, Family Room, Suite',
                'benefit' => "Lingkungan hotel lebih tenang dibanding area yang tepat di depan masjid.\nPelayanan hotel cukup baik untuk kategori premium.\nHotel modern dengan fasilitas lengkap.\nKamar relatif luas dan nyaman.\nCocok untuk keluarga besar.",
                'recommendation' => 'Rekomendasi untuk Jamaah keluarga dan tamu premium yang mengutamakan kenyamanan kamar.',
                'gallery' => $g('anMAu0oxc33Hewh8Gw9FIH0pTGyoqSlEDZ9CxmBq.jpg', 'mKHaw8gcm3u67nJeijmaLfQRbIHAbzmE8wxuyyGi.jpg', 'AgJyKtOZduptUlLVA4FWk07t43HvIAUZreqsAqiL.jpg', 'kUDwOwJRxb3DUEE0TUgUljmm7a5538sq48R4XWxp.jpg'),
            ],
        ];
    }

    // ------------------------------------------------------------------ Visa

    protected function syncVisa(): void
    {
        $category = $this->category('visa');
        $category->update(['page_type' => 'catalog', 'item_label' => 'Visa']);
        $service = $this->service($category, 'visa-umroh', [
            'title' => 'Visa Umroh',
            'short_description' => 'Pengurusan visa umroh cepat & terpercaya',
        ]);

        $rows = [
            [
                'slug' => 'visa-umroh', 'title' => 'Visa Umroh', 'price_per_night' => 300,
                'image' => 'service-items/IqioBy2vlkHRaEMvy8BSgpBGmKSQ2f7jGPOSISIH.jpg',
                'description' => '<p>Visa Umroh adalah visa yang digunakan oleh jamaah untuk masuk ke Arab Saudi dengan tujuan utama melaksanakan ibadah Umroh.</p><p>Pada visa Umroh biasanya terdapat informasi seperti:</p><ul><li>Nama jamaah</li><li>Nomor paspor</li><li>Nomor visa</li><li>Tanggal penerbitan</li><li>Masa berlaku</li><li>Durasi tinggal</li><li>Jenis visa: Umrah</li><li>Umrah Operator</li><li>External Agent</li><li>Nomor aplikasi/barcode</li></ul><p>Pemerintah Saudi saat ini menyediakan layanan pengajuan Visa Umroh melalui platform visa resmi dan prosesnya terhubung dengan sistem Umroh/Nusuk.</p><p>Cocok untuk:<br>Jamaah yang memang membeli perjalanan Umroh melalui travel/agen resmi.</p>',
            ],
            [
                'slug' => 'visa-umroh-group-group', 'title' => 'Visa Umroh Group', 'price_per_night' => 250,
                'image' => 'service-items/cm9pr3DDJTliO6bAvqMN9XVdSGxdA03djSzYJE0r.jpg',
                'description' => '<p>Visa Umroh Group pada dasarnya tetap merupakan Visa Umroh, tetapi jamaah diproses sebagai bagian dari rombongan/group yang terdaftar dalam program Umroh.</p><p>Jadi jangan menganggap "Group Visa" sebagai kartu visa yang bentuknya pasti berbeda. Setiap jamaah tetap mempunyai data visa masing-masing.</p><p>Contohnya:<br>Group Umroh &rarr; 30 jamaah</p><ul><li>Jamaah 1 &rarr; Visa Umroh sendiri</li><li>Jamaah 2 &rarr; Visa Umroh sendiri</li><li>Jamaah 3 &rarr; Visa Umroh sendiri</li><li>dst.</li></ul><p>Namun seluruh jamaah terhubung dengan program/group/operator yang sama.</p>',
            ],
            [
                'slug' => 'visa-umroh-group-bis', 'title' => 'Visa Umroh Group + Bis', 'price_per_night' => 350,
                'image' => 'service-items/Vj3TMJycSiz210Olb7xgvgfXfb88ARPYEOxhsOSk.jpg',
                'description' => '<p>Visa Umroh + Bis biasanya merupakan nama paket layanan travel, bukan jenis visa resmi yang berdiri sendiri.</p><p>Paket ini berarti jamaah mendapatkan isa Umroh sekaligus layanan transportasi darat menggunakan bus selama perjalanan Umroh.</p><p>Contohnya:</p><ul><li>Visa Umroh</li><li>Bus Makkah &rarr; Madinah</li><li>Bus Madinah &rarr; Makkah/Jeddah</li><li>Transportasi untuk kegiatan ziarah</li></ul>',
            ],
            [
                'slug' => 'visa-individu', 'title' => 'Visa Individu', 'price_per_night' => 400,
                'image' => 'service-items/Qtdfx2uqfPQ34qMdAclnvVwOnCQ3bl9S3JJIbc1O.jpg',
                'description' => '<p>Visa Individu berarti pengurusan visa dilakukan per orang, bukan sebagai satu rombongan paket Umroh.</p><p>Namun istilah "visa individu" cukup luas. Bisa merujuk pada visa kunjungan tertentu, termasuk visa visit/tourist yang memungkinkan aktivitas tertentu.</p><p>Saudi saat ini memiliki kategori Visit Visa, yang dapat digunakan untuk tujuan seperti tourism, family/friends, business, dan Umrah sesuai ketentuan visa tersebut.</p><p><strong>Kelebihan</strong></p><ul><li>Lebih fleksibel</li><li>Tidak harus mengikuti rombongan</li><li>Bisa mengatur perjalanan sendiri</li><li>Cocok untuk keluarga atau traveler yang ingin mandiri</li></ul><p>Perhatian: jenis visit/tourist visa yang tersedia dan kelayakannya bergantung pada kewarganegaraan dan aturan yang berlaku.</p>',
            ],
            [
                'slug' => 'visa-transit-saudi', 'title' => 'Visa Transit Saudi', 'price_per_night' => 150,
                'image' => 'service-items/0hKI3g8Qhr0ZNWGBtSoXZrSpGEMp08KOAO0q21K9.jpg',
                'description' => '<p>Visa Transit Saudi digunakan untuk orang yang melewati Arab Saudi dalam perjalanan menuju negara lain.</p><p>Contoh:<br>Indonesia &rarr; Saudi Arabia &rarr; Turki<br>atau<br>Indonesia &rarr; Jeddah &rarr; negara lain</p><p>Saudi menyediakan Transit/Stopover Visa untuk kunjungan singkat. Informasi resmi saat ini menyebut stopover dapat memungkinkan tinggal hingga 96 jam, sedangkan halaman layanan transit pemerintah juga menyebut pilihan 48 dan 96 jam.</p><p>Visa ini dapat menarik bagi jamaah yang ingin memanfaatkan perjalanan transit untuk:</p><ul><li>Singgah di Jeddah</li><li>Mengunjungi Madinah</li><li>Melakukan Umroh jika memenuhi ketentuan</li><li>Kemudian melanjutkan perjalanan ke negara tujuan</li></ul><p>Namun Transit Visa bukan pengganti Visa Umroh biasa untuk perjalanan Umroh dengan durasi lebih panjang.</p>',
            ],
            [
                'slug' => 'visa-brn-hotel', 'title' => 'Visa BRN + Hotel', 'price_per_night' => 500,
                'image' => 'service-items/xreJrAuhpIllBrlgUaziZe0pcgKvIrl4MaX53SXm.jpg',
                'description' => '<p>BRN + Hotel biasanya bukan nama jenis visa.</p><p>BRN berkaitan dengan booking/reference akomodasi yang digunakan dalam proses operasional Umroh. Dalam praktik travel, istilah ini bisa digunakan untuk paket:</p><p>Visa + BRN + Hotel<br>Artinya travel mengurus kombinasi:</p><ol><li>Visa</li><li>Booking/reference hotel</li><li>Akomodasi yang terkait dengan proses perjalanan Umroh</li></ol>',
            ],
            [
                'slug' => 'visa-longstay-shorstay', 'title' => 'Visa Longstay/Shorstay', 'price_per_night' => 600,
                'image' => 'service-items/UAWy8djGUGYFtUwqd7QOdFP1hSt0Vv2D4t0sBCQU.jpg',
                'description' => '<p>Long Stay dan Short Stay lebih tepat dipahami sebagai kategori berdasarkan lama tinggal, bukan selalu nama satu jenis visa Saudi tertentu.</p><p><strong>Short Stay</strong><br>Visa/perizinan yang memungkinkan seseorang berada di Saudi dalam waktu relatif singkat.<br>Contoh:</p><ul><li>Transit</li><li>Kunjungan singkat</li><li>Tourism</li><li>Umroh dengan durasi sesuai visa</li></ul><p><strong>Long Stay</strong><br>Visa yang memungkinkan tinggal lebih lama, tergantung kategori visa dan tujuan.<br>Contoh kategori yang dapat memiliki periode lebih panjang:</p><ul><li>Family Visit</li><li>Multiple-entry visit</li><li>Residence-related visa</li><li>Visa kerja tertentu</li></ul>',
            ],
        ];

        $this->replaceItems($service, $rows);
    }

    // ---------------------------------------------------------- Transportasi

    protected function syncTransportasi(): void
    {
        $category = $this->category('transportasi');
        $category->update(['page_type' => 'transport']);

        $this->dropServices($category);

        $vehicles = [
            ['title' => 'Camry', 'slug' => 'camry', 'price_sar' => 210, 'image' => 'services/tpUpbntPKHxe4jI2a4e5tcoDw5vFwFBVJFyp49tF.png'],
            ['title' => 'Ford', 'slug' => 'ford', 'price_sar' => 310, 'image' => 'services/1DJZ7WPqocLmxjQWNHjbZjqTbaImrkzwszDeWx9g.jpg'],
            ['title' => 'Lexus', 'slug' => 'lexus', 'price_sar' => 360, 'image' => 'services/A3TNoXovad8dzJP192PAtC1v5SsHDuCet24l5KNH.png'],
            ['title' => 'Traverse', 'slug' => 'traverse', 'price_sar' => 360, 'image' => 'services/jcgwEVgf37HBhELkxPJmUx9qZJAQFANcOKFNTqw9.jpg'],
            ['title' => 'GMC', 'slug' => 'gmc', 'price_sar' => 360, 'image' => 'services/wSqOQLLWg7UAajDlMIJKw1agzFy66RZMwCbHjuFN.jpg'],
            ['title' => 'Staria', 'slug' => 'staria', 'price_sar' => 310, 'image' => 'services/4mvsxhtEZPJ5ZPLGQ45UhHL458pd1rKWweF72QNz.jpg'],
            ['title' => 'Hiace', 'slug' => 'hiace', 'price_sar' => 310, 'image' => 'services/xcjGftKaJa7XfgoKRXdc6W5z83GftNRIG47IbC0j.png'],
            ['title' => 'Coaster', 'slug' => 'coaster', 'price_sar' => 310, 'image' => 'services/XcnUtpEo5IMPNQAqcLqNMKqPGxDjHgDfEpl9xJTl.jpg'],
            ['title' => 'Bus', 'slug' => 'bus', 'price_sar' => 260, 'image' => 'services/MZBRs37IDYDksJv3nLICEeYZDi5d4m0NFPjAfg4Y.jpg'],
        ];

        foreach ($vehicles as $v) {
            Service::updateOrCreate(
                ['category_id' => $category->id, 'slug' => $v['slug']],
                array_merge(['status' => true], $v)
            );
        }
    }

    // -------------------------------------------------------------- Catering

    protected function syncCatering(): void
    {
        $category = $this->category('catering');
        $category->update(['page_type' => 'catalog']);

        $kedatangan = $this->service($category, 'kedatangan', [
            'title' => 'Kedatangan',
            'short_description' => 'Hidangan siap santap untuk menyambut jamaah setelah tiba di Indonesia.',
            'image' => 'services/EynihUJqOxFyDvTutSVGVrRoKo5AF9OsW5pf6WPt.jpg',
        ]);
        $kepulangan = $this->service($category, 'kepulangan', [
            'title' => 'Kepulangan',
            'short_description' => 'Bekal makanan praktis untuk menemani jamaah sebelum perjalanan menuju Tanah Suci.',
            'image' => 'services/c7HahG20dUiS7jrlVI61SyPBrpGPFMwKFuMCWpUU.jpg',
        ]);

        // Slug mengikuti produksi (hasil rename historis, auto-slug unik).
        $this->replaceItems($kedatangan, [
            [
                'slug' => 'nasi-box-perjalanan', 'title' => 'Nasi Box', 'price_per_night' => 100,
                'image' => 'service-items/wpgr5s1JIfVIvTPAZbBtKqqbJ5p7ODEzy1YTnBIM.jpg',
                'description' => '<p>Paket makanan lengkap yang dikemas praktis untuk dibawa selama perjalanan menuju bandara atau titik keberangkatan.</p>',
            ],
            [
                'slug' => 'snack-perjalanan', 'title' => 'Snack Box', 'price_per_night' => 100,
                'image' => 'service-items/PFEdFt949dBPFaxptf8UceLIOdHVRbfBG2clQCdV.jpg',
                'description' => '<p>Paket makanan ringan yang praktis dibawa dan dikonsumsi jamaah selama perjalanan menuju bandara maupun saat menunggu keberangkatan.</p>',
            ],
        ]);

        $this->replaceItems($kepulangan, [
            [
                'slug' => 'nasi-box-perjalanan-2', 'title' => 'Nasi Box Perjalanan', 'price_per_night' => 100,
                'image' => 'service-items/teKNwWuMScYlhOeVFhaE9aCskgVnO4wBoY0YbwHk.jpg',
                'description' => '<p>Paket makanan utama yang dikemas praktis untuk dibawa selama perjalanan menuju bandara atau titik keberangkatan.</p>',
            ],
            [
                'slug' => 'snack-perjalanan-2', 'title' => 'Snack Perjalanan', 'price_per_night' => 100,
                'image' => 'service-items/HPG3PQJPiIRIBT1IdbxZe1vWVKSLWWtekreBk4lC.jpg',
                'description' => '<p>Makanan ringan yang mudah dibawa dan dikonsumsi selama perjalanan, cocok sebagai pendamping sebelum jamaah melanjutkan penerbangan.</p>',
            ],
        ]);
    }

    // -------------------------------------------------------------- Handling

    protected function syncHandling(): void
    {
        $category = $this->category('handling');
        $service = $this->service($category, 'handling-umroh', [
            'title' => 'Handling Umroh',
            'short_description' => 'HANDLING ONLY · Duration 9 Days',
            'duration' => '9 Hari',
        ]);

        $benefitBase = "Handling Bandara Kedatangan & Kepulangan\nTipping Bandara\nMeal Box Kedatangan & Kepulangan\nCheck In & Check Out Hotel Mekkah & Madinah\nTeam Distribusi Koper depan kamar Jamaah\nSnack City Tour Mekkah, Madinah & Thaif\nWelcome Drink hotel kedatangan pertama";

        $rows = [
            [
                'slug' => 'silver', 'title' => 'SILVER',
                'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5"><li>35–47 Pax — $73.00/Pax</li><li>25–34 Pax — $78.00/Pax</li><li>16–24 Pax — $98.00/Pax</li><li>11–15 Pax — $173.00/Pax</li></ul>',
                'benefit' => $benefitBase . "\nAir Zam-Zam 5 Liter\nMuthawwifah Raudhah",
                'pax_prices' => [['min' => 35, 'max' => 47, 'price' => 73], ['min' => 25, 'max' => 34, 'price' => 78], ['min' => 16, 'max' => 24, 'price' => 98], ['min' => 11, 'max' => 15, 'price' => 173]],
            ],
            [
                'slug' => 'gold', 'title' => 'GOLD',
                'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5"><li>35–47 Pax — $80.00/Pax</li><li>25–34 Pax — $85.00/Pax</li><li>16–24 Pax — $105.00/Pax</li><li>11–15 Pax — $181.00/Pax</li></ul>',
                'benefit' => $benefitBase . "\nAir Zam-Zam 5 Liter & Al Baik\nMuthawwifah Raudhah",
                'pax_prices' => [['min' => 35, 'max' => 47, 'price' => 80], ['min' => 25, 'max' => 34, 'price' => 85], ['min' => 16, 'max' => 24, 'price' => 105], ['min' => 11, 'max' => 15, 'price' => 181]],
            ],
            [
                'slug' => 'platinum', 'title' => 'PLATINUM',
                'description' => '<p class="font-semibold">Pax &amp; Price:</p><ul class="list-disc pl-5"><li>35–47 Pax — $93.00/Pax</li><li>25–34 Pax — $108.00/Pax</li><li>16–24 Pax — $123.00/Pax</li><li>4–15 Pax — $193.00/Pax</li></ul>',
                'benefit' => $benefitBase . "\nAir Zam-Zam 5 Liter & Al Baik\nMuthawwifah Raudhah\nWelcome Food di kamar Jamaah (Air Zam-Zam 5 L, Kurma, Buah)",
                'pax_prices' => [['min' => 35, 'max' => 47, 'price' => 93], ['min' => 25, 'max' => 34, 'price' => 108], ['min' => 16, 'max' => 24, 'price' => 123], ['min' => 4, 'max' => 15, 'price' => 193]],
            ],
        ];

        $this->replaceItems($service, $rows);
    }

    // --------------------------------------------------- Laundry/Buggy/Kursi

    protected function syncLaundry(): void
    {
        $category = $this->category('laundry');
        // Produksi /category/laundry = kartu Paket 1/2 + form (show_form).
        $category->update(['page_type' => 'form']);
        // Slug mengikuti produksi: /service/laundry (form konsultasi + item Paket 1/2).
        Service::where('category_id', $category->id)
            ->where('slug', 'laundry-kilat')
            ->update(['slug' => 'laundry']);
        $service = $this->service($category, 'laundry', [
            'title' => 'Laundry Kilat',
            'short_description' => 'Layanan laundry kilat, bersih & wangi',
        ]);

        $this->replaceItems($service, [
            ['slug' => 'paket-1', 'title' => 'Paket 1', 'tagline' => '1-5 Kg', 'price_per_night' => 15, 'image' => 'service-items/RwbI4k8TkzyOT0q3C4F8x1DNBpL2hXq65hdIy8zf.jpg'],
            ['slug' => 'paket-2', 'title' => 'Paket 2', 'tagline' => '5-10 Kg', 'price_per_night' => 13, 'image' => 'service-items/qTC9YOGkrH5gEJVYgLgBBwjbjPPxSWSDywvPSNzH.jpg'],
        ]);
    }

    protected function syncBuggy(): void
    {
        $category = $this->category('buggy-car');
        // Produksi /category/buggy-car = kartu item + form (show_form).
        $category->update(['page_type' => 'form']);
        $service = $this->service($category, 'buggy-car-haram', [
            'title' => 'Buggy Car Area Haram',
            'short_description' => 'Antar-jemput buggy di sekitar Masjidil Haram',
        ]);

        $this->replaceItems($service, [
            ['slug' => 'tawaf', 'title' => 'Tawaf', 'price_per_night' => 110, 'info' => 'Layanan buggy antar-jemput mengelilingi Ka\'bah', 'image' => 'service-items/QEOv9UgB1w7tvAKED5jSDN9Jll3Rkh6SjXpB7jph.jpg'],
            ['slug' => 'sai', 'title' => 'Sa\'i', 'price_per_night' => 110, 'info' => 'Layanan buggy antar-jemput Safa–Marwah', 'image' => 'service-items/kUhk6jjvZJon3YjAZ31wJt5pH6FaKHOVjChsGIoR.jpg'],
            ['slug' => 'umroh-tawaf-sai', 'title' => 'Umroh (Tawaf + Sa\'i)', 'price_per_night' => 220, 'info' => 'Paket lengkap Tawaf + Sa\'i, lebih hemat', 'image' => 'service-items/OqDfszIsOyih2wDdfQifVCUphFFpx5MsUfU2t0tj.jpg'],
        ]);
    }

    protected function syncKursiRoda(): void
    {
        $category = $this->category('kursi-roda-umroh');
        // Produksi /category/kursi-roda-umroh = kartu item + form (show_form).
        $category->update(['page_type' => 'form']);
        $service = $this->service($category, 'kursi-roda-sewa', [
            'title' => 'Sewa Kursi Roda',
            'short_description' => 'Sewa kursi roda untuk jamaah lansia / berkebutuhan khusus',
        ]);

        $this->replaceItems($service, [
            ['slug' => 'tawaf', 'title' => 'Tawaf', 'price_per_night' => 150, 'info' => 'Didorong petugas berpengalaman mengelilingi Ka\'bah', 'image' => 'service-items/6XFExiuiXLopEzNcXHPyC4ArX8zpgSunqWzY1wEe.jpg'],
            ['slug' => 'sai', 'title' => 'Sa\'i', 'price_per_night' => 150, 'info' => 'Didorong petugas via jalur Safa–Marwah', 'image' => 'service-items/z5ucApID1W70NIi2auFvyA97F2n6giSRJ81K4az3.jpg'],
            ['slug' => 'umroh-tawaf-sai', 'title' => 'Umroh (Tawaf + Sa\'i)', 'price_per_night' => 350, 'info' => 'Paket lengkap dengan pendampingan petugas', 'image' => 'service-items/y4CVbrCAXHhgb01B9HjYYwuCa8ps2fA9Uo9BcFip.jpg'],
        ]);
    }

    protected function syncMuthawif(): void
    {
        $category = $this->category('muthawif');
        // Produksi /category/muthawif = kartu item + form (show_form).
        $category->update(['page_type' => 'form']);
        // Slug mengikuti produksi: /service/muthawif (3 orang; Faqih tidak ada di produksi).
        Service::where('category_id', $category->id)
            ->where('slug', 'muthawif-per-hari')
            ->update(['slug' => 'muthawif']);
        $service = $this->service($category, 'muthawif', [
            'title' => 'Muthawif Per Hari',
            'short_description' => 'Pembimbing ibadah muthawif selama di Tanah Suci',
        ]);

        $images = [
            'Mohammad Jadid' => 'service-items/LT51j5WzebOsEZEDZLeQ2O7vVzGxNQ6MrGM3DVJ4.jpg',
            'A. Najian Muzaki' => 'service-items/QpbJPSFdCK9Wxdmj3CpybACc9B7zvgO3dSCMkBEB.jpg',
            'Asep Saepuloh' => 'service-items/V63D6vH1fRmqsxI3zKUcgemcKe5KTM8pRsxIIsii.jpg',
        ];
        $rows = [];
        foreach (['Mohammad Jadid', 'A. Najian Muzaki', 'Asep Saepuloh'] as $name) {
            $rows[] = [
                'slug' => \Illuminate\Support\Str::slug($name),
                'title' => $name,
                'price_per_night' => 300,
                'image' => $images[$name],
                'description' => '<p>Muthawif Harian, Mingguan &amp; Bulanan</p>',
            ];
        }

        $this->replaceItems($service, $rows);
    }

    // --------------------------------------------------------- Penukaran Uang

    protected function syncPenukaran(): void
    {
        // Produksi: hanya form konsultasi, tanpa item layanan.
        $category = $this->category('penukaran-uang');
        $service = $this->service($category, 'penukaran-riyal', [
            'title' => 'Penukaran Riyal',
            'short_description' => 'Penukaran uang Riyal Saudi dengan rate terbaik',
        ]);
        ServiceItem::where('service_id', $service->id)->delete();
    }

    // ---------------------------------------------------------------- Jastip

    protected function syncJastip(): void
    {
        $category = $this->category('jastip-viral');
        $category->update(['page_type' => 'catalog', 'group_label' => 'Kategori', 'item_label' => 'Produk']);
        $this->dropServices($category);

        $groups = [
            [
                'title' => 'Oleh-Oleh Khas Arab Saudi',
                'slug' => 'oleh-oleh-khas-arab-saudi',
                'image' => 'services/eehpAmcdZvKnc71f1X34ZBB4REJZhP9pf702HoMv.jpeg',
                'short_description' => 'Berbagai oleh-oleh khas Tanah Suci yang populer dibawa pulang oleh jamaah.',
                'items' => [
                    ['slug' => 'kurma-ajwa', 'title' => 'Kurma Ajwa', 'image' => 'service-items/UL9WGGjK8rHIgDHMLoBUvV9WGzwqDRvCq4gXW1gp.jpg', 'description' => 'Kurma Ajwa dari Madinah yang menjadi salah satu oleh-oleh favorit jamaah untuk dibawa pulang sebagai buah tangan bagi keluarga dan kerabat di Indonesia.'],
                    ['slug' => 'kurma-premium', 'title' => 'Kurma Premium', 'image' => 'service-items/SLlolVVI53ifVWWg6rJE8rDutaYv1ZeFz9QlDp7M.jpeg', 'description' => 'Pilihan berbagai jenis kurma berkualitas dari Arab Saudi dengan kemasan yang cocok untuk oleh-oleh.'],
                    ['slug' => 'cokelat-arab', 'title' => 'Cokelat Arab', 'image' => 'service-items/olmoiM1b4kYmmNLLKjyvTNltvslJEQdQAxh9wO4Y.jpeg', 'description' => 'Beragam cokelat khas dan populer di Arab Saudi yang dapat menjadi pilihan oleh-oleh praktis untuk keluarga maupun rekan kerja.'],
                ],
            ],
            [
                'title' => 'Oleh-Oleh Islami',
                'slug' => 'oleh-oleh-islami',
                'image' => 'services/8ZVoFXQgcIQu089rrQDqSXxXt4T8TmVlwGpm8Lj3.jpeg',
                'short_description' => 'Pilihan perlengkapan dan cendera mata bernuansa Islami dari Tanah Suci.',
                'items' => [
                    ['slug' => 'tasbih', 'title' => 'Tasbih', 'image' => 'service-items/GUZEyZRpEuXIbRp5jb2j5c8fI6sSbMBtkcf0BoK8.jpeg', 'description' => 'Tasbih dengan berbagai pilihan bahan, warna, dan model yang cocok sebagai oleh-oleh untuk keluarga maupun kerabat.'],
                    ['slug' => 'sajadah', 'title' => 'Sajadah', 'image' => 'service-items/trqoDzqx8vLto9zQn963aLhzJ7GP4py4xhG0MNUp.jpeg', 'description' => 'Sajadah dengan beragam motif dan kualitas yang dapat dipilih sebagai buah tangan dari perjalanan ke Tanah Suci.'],
                    ['slug' => 'parfum-non-alkohol', 'title' => 'Parfum Non-Alkohol', 'image' => 'service-items/XloqAuNCu3O3cWSHGOsySuEUYxlhd7zQFtKSMdlZ.jpeg', 'description' => 'Pilihan parfum dan wewangian khas Timur Tengah yang populer sebagai oleh-oleh, dengan beragam aroma dan ukuran.'],
                ],
            ],
            [
                'title' => 'Produk Viral & Populer',
                'slug' => 'produk-viral-populer',
                'image' => 'services/OEecHtpBDXz0yMMKOGlkvPV94WzXMWkjEBdHYUCz.jpg',
                'short_description' => 'Membantu mendapatkan berbagai produk yang sedang populer dan banyak dicari dari Arab Saudi.',
                'items' => [
                    ['slug' => 'camilan-makanan-populer', 'title' => 'Camilan & Makanan Populer', 'image' => 'service-items/iEJCcaeu0mH0iG1qJZSOsgQDGh1MtRCgsszKd9Ri.jpeg', 'description' => 'Berbagai camilan, makanan ringan, dan produk makanan populer yang dapat dititipkan sesuai ketersediaan dan ketentuan pengiriman.'],
                    ['slug' => 'produk-khas-madinah', 'title' => 'Produk Khas Madinah', 'image' => 'service-items/KcOkp4yNivk3eT5Snltl5KZQtPSTINDsYurBkmva.jpg', 'description' => 'Pilihan produk khas Madinah yang banyak diminati jamaah sebagai oleh-oleh dan buah tangan untuk keluarga di Indonesia.'],
                    ['slug' => 'permintaan-khusus', 'title' => 'Permintaan Khusus', 'image' => 'service-items/n1Qq86Kx0HW55EKl4X6tZUrfeTAR3CFdotQG5H49.jpeg', 'description' => 'Layanan titip pembelian berdasarkan permintaan jamaah, selama barang tersedia dan memenuhi ketentuan yang berlaku untuk dibawa ataupun dikirim.'],
                ],
            ],
        ];

        foreach ($groups as $group) {
            $items = $group['items'];
            unset($group['items']);

            $service = Service::create(array_merge($group, [
                'category_id' => $category->id,
                'status' => true,
            ]));

            $this->replaceItems($service, array_map(fn ($item) => array_merge($item, [
                'price_per_night' => 100,
                'description' => '<p>' . $item['description'] . '</p>',
            ]), $items));
        }
    }

    // ------------------------------------------------------------ Fotografer

    protected function syncFotografer(): void
    {
        $category = $this->category('fotografer');
        $category->update([
            'page_type' => 'form',
            'item_label' => 'Kegiatan',
        ]);

        $this->dropServices($category);

        $service = Service::create([
            'category_id' => $category->id,
            'title' => 'Fotografer',
            'slug' => 'fotografer',
            'short_description' => 'Layanan dokumentasi foto & video perjalanan ibadah oleh fotografer profesional.',
            'price' => 750000,
            'price_sar' => 150,
            'status' => true,
        ]);

        $g = fn (string ...$files) => array_map(fn ($f) => 'galleries/' . $f, $files);

        $items = [
            ['title' => 'Ziarah Nabawi', 'slug' => 'ziarah-nabawi', 'sar' => 300, 'idr' => 1500000, 'image' => 'service-items/zEykRxGGxEG3Ndrrhc8bCwmvvQY8uAvtL50y6JTU.jpg', 'gallery' => $g('6HqMvJeKKZtvOdwUIINse4JxRVDdjRk9FuQO51Hs.jpg', 'tL9TboHWeR7JqjazYC8rUd0TPde1wsjlpGx9eQ2m.jpg', 'sliln1Ai76BjPcyOPU379QpYqYGSzTft4wpTKsUJ.jpg', 'kfGZx76MSAuyf8dAUCqQud3xVakKpjs1UslmSEeu.jpg', 'deB8FxF91aec9jPd1a8UYAXfo7lMjkSOOo1lVAbC.jpg', 'oXUzqmgVAWy7HIOhc23fdiMbLNaeB0XTjbiho03S.jpg')],
            ['title' => 'City Tour Kota Madinah', 'slug' => 'city-tour-kota-madinah', 'sar' => 300, 'idr' => 1500000, 'image' => 'service-items/ORDCnxQBx6bgenh8hCzkN8RW2CVjRb6XaxCo0a1T.jpg', 'gallery' => $g('OaihuDf1HkCbrX4hYoNqznaUtmjqywa54Y2G71OI.jpg', 'MJXJnECQzXbzlmfbnqITyGvNiozC9kSi10aXX7dO.jpg', 'CSh29lbvdiA4m7fdW5gxj0B6SXvAVgQDVTqnCmeV.jpg', 'H1XFvz0Q0K4UlTAZxHAwusOFLEddQnTNLj0C3ZzE.jpg', 'mka84ZLJBaHiuA2qCEYzPahasewug4OQPMknuRdM.jpg')],
            ['title' => 'Raudoh Laki-laki', 'slug' => 'raudoh-laki-laki', 'sar' => 200, 'idr' => 1000000, 'image' => null, 'gallery' => $g('JfUkAgoBdPKH37bflxXQuLbVFLwjgrrcwhCtJxO8.jpg', 'F8krda6o3DPHRG9gx6cCs1x34AyKDHamtugfJW74.jpg', 'BIcz9guxI19QzBr4mcufEqfgp7EG9dXW5Su7pq0R.jpg', 'bWubDjikEJ31er19n8Tb6Xb7wgekPyADBXUO1hbd.jpg')],
            ['title' => 'Raudoh Perempuan (sekaligus Mutowifah)', 'slug' => 'raudoh-perempuan-sekaligus-mutowifah', 'sar' => 300, 'idr' => 1500000, 'image' => null, 'gallery' => $g('BJgcCZpECJIZFrD2A15H5pIouWkGX7W6B1xmltQw.jpg', 'WrDAUUiRwqRCaO9mY1k7oUt3WXrw6YjcDeqyiuan.jpg', 'uFY7AemotXBbFXUn5Fbq7e9ERHtUHG45hXX0I9kQ.jpg')],
            ['title' => 'Dokumentasi Kereta Cepat', 'slug' => 'dokumentasi-kereta-cepat', 'sar' => 150, 'idr' => 750000, 'image' => null, 'gallery' => $g('GPxLimiZkQ0fU59G23ktmxeoBHfcUlqViI69dTTn.jpg', 'Ygf3EHjvxAEwVV6L04JUAJ10nI1z4bRaFvszaVTZ.jpg', 'K8RuA8EBo2KwdimlWr3LiufOMLK6PPOqR2xbDw0Q.jpg', '75R4IeNX1QLKoe3yd8BiphKfW0J8RNbljgAyGqu6.jpg', 'XEsZK6Br1Vn0WZgZasTZhGzY55zCf9XUEyZvKrRC.jpg')],
            ['title' => 'Umroh Pertama', 'slug' => 'umroh-pertama', 'sar' => 300, 'idr' => 1500000, 'image' => null, 'gallery' => $g('imrVQTlDt59gdIWoKzkBM2vAK4EId97Uw35zvBxF.jpg', 'A8h3Lg9Nisjat20AjIo1HQMxguMeZTXTCKj8mI9h.jpg', 'y1aqxc2vqvcGXbcAisAA2uf2kQwHVb8vWglfujAD.jpg', 'eWtGDfRjt727qT1j7G9dYcyWSUZfWODVdiobwPPk.jpg', 'jrbgECC6uLIkZIFbQirKCPddN16Hv8Tmbt6vT5DO.jpg', 'cF2tMn55ehUOHQSZvqm4MExF0CQwGVmUFRgC2lgX.jpg')],
            ['title' => 'City Tour Kota Mekkah dan Umroh 2', 'slug' => 'city-tour-kota-mekkah-dan-umroh-2', 'sar' => 400, 'idr' => 2000000, 'image' => null, 'gallery' => $g('1By1KPESdpXSRNJo4LjLbVZks4L2YHYBfO2ISqLs.jpg', 'pH5TJ9TINYbmo6OKkx83Putcc7QPxil5Oxq4GDMg.jpg', 'lT5XRhGvaoS8b9JT5Lrh1632WGWmlaIEld0YzuFk.jpg', 'vjMtrd5ITzmhJrLUOoNYnSAdQ6JBWqrnIHtfWo1p.jpg', 'VpY48CXiU1eYM82eatQceOUzZ8uLETDp1EUa1xne.jpg', 't6tuqyF3CxMWttU8G5qAJQtZ4NIkq21cQVWOAcDh.jpg', 'WRoie1amSnWUFKPZyA6nc3eaTy89Y1IFxwLF3VpL.jpg')],
            ['title' => 'City Tour Kota Thoif', 'slug' => 'city-tour-kota-thoif', 'sar' => 300, 'idr' => 1500000, 'image' => null, 'gallery' => $g('NIOQA9w0nijSz9zgk6cy8AX4xjtctfHEfW6JE92L.jpg', '8YyNPmzTEGD9KfNGnYRiiq61urKsQxU4jKGP7ZCm.jpg', 'hByEHO6ee6oj7smvQEXXRw1vg2kKdmhXosPSePLA.jpg', 'o0xVFSy7Ny8NYH0zuBnxYxzJO7782PtU0VYiG799.jpg')],
            ['title' => 'City Tour Al Oula', 'slug' => 'city-tour-al-oula', 'sar' => 750, 'idr' => 3750000, 'image' => null, 'gallery' => $g('lBOARdYCocVlZ1rYGtufRWu2r5PZ4o6GSWHdRBqw.jpg', 'HuXZR4rfVnpaicuhcglEL3vh1NvzllVx4PfDbPgi.jpg', 'NdPDBf66RK0hvVo9VVcZmyfWSg3dd3T5VnjJtdn7.jpg', 'vXLeLGpDeq0xNWnwYBV4ZgeJgDnCrOi79kZALUvu.jpg', 'Sp9loFZ2uQHG352uMBQ71yrPmd8T4uQRf2WaOUiw.jpg', '7Jb1Uoe6aSWx5SISejIfeiYRpL0CDQp7kr2eJpEc.jpg')],
        ];

        $rows = [];
        foreach ($items as $row) {
            $rows[] = [
                'slug' => $row['slug'],
                'title' => $row['title'],
                'tagline' => 'Dokumentasi foto profesional',
                'description' => '<p>Sesi dokumentasi <b>' . e($row['title']) . '</b> bersama fotografer berpengalaman. Hasil foto diedit dan dikirim melalui WhatsApp / Google Drive.</p>',
                'info' => 'Tarif: SAR ' . number_format($row['sar'], 0, ',', '.') . ' (± Rp ' . number_format($row['idr'], 0, ',', '.') . ') per kegiatan.',
                'price_per_night' => $row['sar'],
                'image' => $row['image'],
                'gallery' => $row['gallery'],
            ];
        }

        $this->replaceItems($service, $rows);
    }
}
