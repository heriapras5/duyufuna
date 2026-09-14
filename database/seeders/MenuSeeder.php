<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hotel', 'slug' => 'hotel', 'icon' => '🏨', 'subtitle' => 'Akomodasi terbaik', 'sort' => 1, 'description' => 'Pilihan hotel terbaik di Mekkah dan Madinah untuk kenyamanan ibadah Anda.', 'meta_title' => 'Hotel Umroh Mekkah Madinah', 'meta_description' => 'Pilih hotel terbaik di area Masjidil Haram dan Masjid Nabawi untuk perjalanan umroh Anda.', 'meta_keywords' => 'hotel umroh, hotel mekkah, hotel madinah'],
            ['name' => 'Visa', 'slug' => 'visa', 'icon' => '📋', 'subtitle' => 'Proses cepat & aman', 'sort' => 2, 'description' => 'Pengurusan visa umroh yang cepat, aman, dan terpercaya.', 'meta_title' => 'Visa Umroh', 'meta_description' => 'Pengurusan visa umroh cepat dan terpercaya.', 'meta_keywords' => 'visa umroh, paspor umroh, syarat visa'],
            ['name' => 'Transportasi', 'slug' => 'transportasi', 'icon' => '🚐', 'subtitle' => 'Nyaman & terpercaya', 'sort' => 3, 'description' => 'Armada transportasi nyaman untuk seluruh rute perjalanan umroh Anda.', 'meta_title' => 'Transportasi Umroh', 'meta_description' => 'Sewa transportasi umroh dengan armada nyaman dan terpercaya.', 'meta_keywords' => 'transportasi umroh, sewa bus umroh, travel umroh'],
            ['name' => 'Handling', 'slug' => 'handling', 'icon' => '🛎️', 'subtitle' => 'Layanan profesional', 'sort' => 4, 'description' => 'Layanan handling bandara kedatangan dan kepulangan serta handling hotel check-in dan check-out yang profesional.', 'meta_title' => 'Handling Umroh', 'meta_description' => 'Layanan handling bandara dan hotel untuk jamaah umroh.', 'meta_keywords' => 'handling bandara, handling hotel, check in umroh, check out umroh'],
            ['name' => 'Catering', 'slug' => 'catering', 'icon' => '🍽️', 'subtitle' => 'Menu berkualitas', 'sort' => 6, 'description' => 'Catering halal berkualitas untuk kedatangan dan kepulangan jamaah.', 'meta_title' => 'Catering Umroh', 'meta_description' => 'Catering halal untuk kedatangan dan kepulangan jamaah umroh dengan menu pilihan.', 'meta_keywords' => 'catering umroh, paket makan, katering bandara'],
            ['name' => 'Laundry', 'slug' => 'laundry', 'icon' => '👕', 'subtitle' => 'Bersih & wangi', 'sort' => 7, 'description' => 'Layanan laundry cepat, bersih, dan wangi selama di Tanah Suci.', 'item_label' => 'Paket Laundry', 'meta_title' => 'Laundry Umroh', 'meta_description' => 'Layanan laundry untuk jamaah umroh dengan hasil bersih dan wangi.', 'meta_keywords' => 'laundry umroh, laundry mekkah, laundry madinah'],
            ['name' => 'Buggy Car', 'slug' => 'buggy-car', 'icon' => '🚗', 'subtitle' => 'Fleksibel & nyaman', 'sort' => 8, 'description' => 'Layanan buggy car untuk mobilitas jamaah di sekitar Masjidil Haram.', 'item_label' => 'Paket Buggy Car', 'meta_title' => 'Buggy Car Umroh', 'meta_description' => 'Sewa buggy car untuk mobilitas jamaah di area Masjidil Haram.', 'meta_keywords' => 'buggy car umroh, buggy mekkah'],
            ['name' => 'Jastip Viral', 'slug' => 'jastip-viral', 'icon' => '🛍️', 'subtitle' => 'Oleh-oleh kekinian', 'sort' => 9, 'description' => 'Titip beli oleh-oleh viral dan kekinian dari Tanah Suci.', 'meta_title' => 'Jastip Viral Tanah Suci', 'meta_description' => 'Jastip oleh-oleh viral dan kekinian dari Tanah Suci.', 'meta_keywords' => 'jastip viral, jastip mekkah, oleh oleh umroh'],
            ['name' => 'Kursi Roda Umroh', 'slug' => 'kursi-roda-umroh', 'icon' => '♿', 'subtitle' => 'Layanan khusus', 'sort' => 10, 'description' => 'Sewa kursi roda untuk jamaah lansia dan berkebutuhan khusus.', 'item_label' => 'Layanan Kursi Roda', 'meta_title' => 'Sewa Kursi Roda Umroh', 'meta_description' => 'Sewa kursi roda untuk jamaah umroh lansia dan berkebutuhan khusus.', 'meta_keywords' => 'kursi roda umroh, sewa kursi roda mekkah'],
            ['name' => 'Fotografer', 'slug' => 'fotografer', 'icon' => '📸', 'subtitle' => 'Fasilitas Grup', 'sort' => 11, 'description' => 'Fotografer profesional untuk mendokumentasikan momen ibadah Anda.', 'item_label' => 'Paket Foto', 'meta_title' => 'Fotografer Umroh', 'meta_description' => 'Fotografer profesional untuk dokumentasi kegiatan umroh Anda.', 'meta_keywords' => 'fotografer umroh, foto umroh'],
            ['name' => 'Penukaran Uang', 'slug' => 'penukaran-uang', 'icon' => '💵', 'subtitle' => 'Rate terbaik', 'sort' => 12, 'description' => 'Penukaran uang dengan kurs terbaik dan terpercaya.', 'item_label' => 'Layanan Penukaran', 'meta_title' => 'Penukaran Uang Umroh', 'meta_description' => 'Penukaran uang Riyal dengan kurs terbaik dan terpercaya.', 'meta_keywords' => 'penukaran uang, money changer umroh'],
            ['name' => 'Muthawif', 'slug' => 'muthawif', 'icon' => '🕋', 'subtitle' => 'Pembimbing ibadah', 'sort' => 13, 'description' => 'Muthawif berpengalaman sebagai pembimbing ibadah selama di Tanah Suci.', 'item_label' => 'Muthawif', 'meta_title' => 'Muthawif Umroh', 'meta_description' => 'Muthawif berpengalaman sebagai pembimbing ibadah jamaah umroh.', 'meta_keywords' => 'muthawif, pembimbing ibadah umroh'],
        ];

        $serviceTemplates = [
            'hotel' => [
                ['title' => 'Mekkah', 'slug' => 'hotel-mekkah', 'short_description' => 'Rekomendasi hotel untuk jamaah umroh di area Masjidil Haram', 'icon' => '🏨'],
                ['title' => 'Madinah', 'slug' => 'hotel-madinah', 'short_description' => 'Rekomendasi hotel untuk jamaah umroh di area Masjid Nabawi', 'icon' => '🕌'],
            ],
            'visa' => [
                ['title' => 'Visa Umroh', 'slug' => 'visa-umroh', 'short_description' => 'Pengurusan visa umroh cepat & terpercaya', 'icon' => '📋'],
            ],
            'transportasi' => [
                ['title' => 'Bus Shalawat', 'slug' => 'transportasi-bus-shalawat', 'short_description' => 'Bus antar-jemput dari hotel ke Masjidil Haram', 'price' => 150000, 'icon' => '🚌'],
                ['title' => 'Sewa Bus 24 Jam', 'slug' => 'transportasi-bus-24jam', 'short_description' => 'Sewa bus khusus untuk kebutuhan perjalanan grup', 'price' => 3500000, 'icon' => '🚌'],
                ['title' => 'Toyota Hiace', 'slug' => 'transportasi-hiace', 'short_description' => 'Mobil Hiace untuk perjalanan keluarga / grup kecil', 'price' => 1800000, 'icon' => '🚐'],
            ],
            'handling' => [
                ['title' => 'Handling Umroh', 'slug' => 'handling-umroh', 'short_description' => 'HANDLING ONLY · Duration 9 Days', 'icon' => '🛎️', 'duration' => '9 Hari'],
            ],
            'catering' => [
                ['title' => 'Kedatangan', 'slug' => 'kedatangan', 'short_description' => 'Catering saat kedatangan bandara', 'icon' => '🛬'],
                ['title' => 'Kepulangan', 'slug' => 'kepulangan', 'short_description' => 'Catering saat kepulangan bandara', 'icon' => '🛫'],
            ],
            'laundry' => [
                ['title' => 'Laundry Kilat', 'slug' => 'laundry-kilat', 'short_description' => 'Layanan laundry kilat, bersih & wangi', 'price' => 50000, 'icon' => '👕'],
            ],
            'buggy-car' => [
                ['title' => 'Buggy Car Area Haram', 'slug' => 'buggy-car-haram', 'short_description' => 'Antar-jemput buggy di sekitar Masjidil Haram', 'price' => 75000, 'icon' => '🚗'],
            ],
            'kursi-roda-umroh' => [
                ['title' => 'Sewa Kursi Roda', 'slug' => 'kursi-roda-sewa', 'short_description' => 'Sewa kursi roda untuk jamaah lansia / berkebutuhan khusus', 'price' => 100000, 'icon' => '♿'],
            ],
            'muthawif' => [
                ['title' => 'Muthawif Per Hari', 'slug' => 'muthawif-per-hari', 'short_description' => 'Pembimbing ibadah muthawif selama di Tanah Suci', 'price' => 250000, 'icon' => '🕋'],
            ],
            'fotografer' => [
                ['title' => 'Semua Jenis Kegiatan', 'slug' => 'foto-semua-kegiatan', 'short_description' => 'Dokumentasi semua kegiatan ibadah', 'price' => 300000, 'icon' => '📸'],
                ['title' => 'Khandamah & Kudai', 'slug' => 'foto-khandamah', 'short_description' => 'Sesi foto di area Khandamah & Kudai', 'price' => 300000, 'icon' => '📸'],
                ['title' => 'Pelataran', 'slug' => 'foto-pelataran', 'short_description' => 'Sesi foto di pelataran Masjidil Haram', 'price' => 300000, 'icon' => '📸'],
            ],
            'penukaran-uang' => [
                ['title' => 'Penukaran Riyal', 'slug' => 'penukaran-riyal', 'short_description' => 'Penukaran uang Riyal Saudi dengan rate terbaik', 'icon' => '💵'],
            ],
            'jastip-viral' => [
                ['title' => 'Tumbler Tanah Suci', 'slug' => 'jastip-tumbler', 'short_description' => 'Tumbler eksklusif oleh-oleh umroh', 'price' => 85000, 'icon' => '🥤'],
                ['title' => 'Parfum Timur Tengah', 'slug' => 'jastip-parfum', 'short_description' => 'Parfum khas Timur Tengah berkualitas', 'price' => 150000, 'icon' => '🧴'],
                ['title' => 'Kurma Sukari', 'slug' => 'jastip-kurma-sukari', 'short_description' => 'Kurma Sukari premium asli Madinah', 'price' => 120000, 'icon' => '🌴'],
                ['title' => 'Tasbih Kayu', 'slug' => 'jastip-tasbih', 'short_description' => 'Tasbih kayu unik dan ringan', 'price' => 45000, 'icon' => '📿'],
            ],
        ];

        foreach ($categories as $catData) {
            $category = Category::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            if (isset($serviceTemplates[$category->slug])) {
                Service::where('category_id', $category->id)->delete();

                foreach ($serviceTemplates[$category->slug] as $svcData) {
                    $svcData['category_id'] = $category->id;
                    $svcData['status'] = true;
                    Service::create($svcData);
                }
            }
        }
    }
}
