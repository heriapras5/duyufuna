<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    protected array $catalog = [
        'hotel-mekkah' => [
            ['title' => 'Swissôtel Al Maqam', 'description' => '<p>Hotel bintang 5 dengan akses langsung ke area Masjidil Haram. Kamar nyaman dengan pemandangan Ka\u0027bah dan fasilitas lengkap untuk jamaah.</p>'],
            ['title' => 'Pullman ZamZam', 'description' => '<p>Hotel bintang 5 menghadap Masjidil Haram, hanya beberapa langkah dari gerbang utama. Dilengkapi restoran halal dan layanan 24 jam.</p>'],
            ['title' => 'Anjum Hotel', 'description' => '<p>Hotel bintang 5 di jantung Mekkah dengan pemandangan Masjidil Haram dari lantai atas, fasilitas rooftop dan akses mudah ke area tawaf.</p>'],
        ],
        'hotel-madinah' => [
            ['title' => 'Madinah Hilton', 'description' => '<p>Hotel bintang 5 berhadapan langsung dengan Masjid Nabawi. Lokasi strategis dengan pemandangan Raudhah dan layanan kamar prima.</p>'],
            ['title' => 'Mövenpick Anwar Al Madinah', 'description' => '<p>Hotel bintang 5 di seberang Masjid Nabawi, setiap kamar menghadap ke kompleks masjid. Berdekatan dengan area ziarah utama.</p>'],
            ['title' => 'Dar Al Taqwa', 'description' => '<p>Hotel bintang 5 berada tepat di halaman Masjid Nabawi, akses paling mudah untuk menunaikan shalat berjamaah dan ziarah.</p>'],
        ],
        'transportasi-bus-shalawat' => [
            ['title' => 'Shalawat Pagi', 'description' => '<p>Antar-jemput bus dari hotel ke Masjidil Haram setiap pagi dengan armada nyaman dan berpendingin.</p>'],
            ['title' => 'Shalawat Malam', 'description' => '<p>Layanan bus antar-jemput pada waktu shalat malam, memudahkan jamaah menjangkau Masjidil Haram dengan aman.</p>'],
            ['title' => 'Shalawat Harian', 'description' => '<p>Paket antar-jemput sepanjang hari untuk jamaah dengan mobilitas terbatas, jadwal fleksibel sesuai kebutuhan grup.</p>'],
        ],
        'transportasi-bus-24jam' => [
            ['title' => 'Sewa Bus Grup 24 Jam', 'description' => '<p>Sewa bus ekslusif 24 jam untuk kebutuhan perjalanan grup, ziarah, dan perpindahan antar kota dengan armada bersih dan berpengalaman.</p>'],
        ],
        'transportasi-hiace' => [
            ['title' => 'Sewa Hiace Keluarga', 'description' => '<p>Sewa Toyota Hiace untuk perjalanan keluarga atau grup kecil, sopir berpengalaman untuk rute dalam kota maupun antar kota.</p>'],
        ],
        'kedatangan' => [
            ['title' => 'Paket Nasi Ayam Kabsah', 'description' => '<p>Nasi kabsah dengan ayam khas Timur Tengah, disajikan hangat saat kedatangan jamaah di bandara.</p>'],
            ['title' => 'Paket Nasi Kebuli', 'description' => '<p>Nasi kebuli gurih dengan daging pilihan, hidangan pembuka yang mengenyangkan untuk jamaah yang baru tiba.</p>'],
            ['title' => 'Paket Snack Box', 'description' => '<p>Snack box praktis berisi roti, buah, dan minuman untuk jamaah dalam perjalanan.</p>'],
        ],
        'kepulangan' => [
            ['title' => 'Paket Nasi Ayam Kabsah', 'description' => '<p>Nasi kabsah dengan ayam khas Timur Tengah untuk bekal jamaah sebelum penerbangan pulang.</p>'],
            ['title' => 'Paket Nasi Mandhi', 'description' => '<p>Nasi mandhi dengan daging yang mengenyangkan, pilihan tepat sebagai bekal kepulangan jamaah.</p>'],
            ['title' => 'Paket Snack Box', 'description' => '<p>Snack box ringan dan higienis untuk perjalanan pulang jamaah umroh.</p>'],
        ],
        'jastip-tumbler' => [
            ['title' => 'Tumbler 350ml', 'description' => '<p>Botol minum eksklusif oleh-oleh Tanah Suci, ukuran pas dan desain khas.</p>'],
            ['title' => 'Tumbler 750ml', 'description' => '<p>Botol minum besar dengan desain unik, cocok untuk menemani perjalanan ibadah.</p>'],
            ['title' => 'Tumbler Stainless', 'description' => '<p>Tumbler tahan panas berbahan stainless steel, awet dan kekinian.</p>'],
        ],
        'jastip-parfum' => [
            ['title' => 'Parfum 50ml', 'description' => '<p>Parfum khas Timur Tengah dengan aroma tahan lama, ukuran 50ml.</p>'],
            ['title' => 'Parfum 100ml', 'description' => '<p>Parfum premium Timur Tengah dalam kemasan 100ml dengan wangi elegan.</p>'],
            ['title' => 'Attar', 'description' => '<p>Attar minyak wangi murni tanpa alkohol, aroma pekat khas Timur Tengah.</p>'],
        ],
        'jastip-kurma-sukari' => [
            ['title' => 'Kurma Sukari 1kg', 'description' => '<p>Kurma Sukari premium asli Madinah, manis dan lembut dalam kemasan 1kg.</p>'],
            ['title' => 'Kurma Sukari 3kg', 'description' => '<p>Kurma Sukari pilihan untuk oleh-oleh keluarga, kemasan 3kg.</p>'],
            ['title' => 'Kurma Sukari Premium', 'description' => '<p>Kurma Sukari grade premium dengan ukuran besar dan kualitas terbaik.</p>'],
        ],
        'jastip-tasbih' => [
            ['title' => 'Tasbih Kayu', 'description' => '<p>Tasbih kayu ringan dan unik, oleh-oleh khas Tanah Suci yang berkesan.</p>'],
            ['title' => 'Tasbih Cemara', 'description' => '<p>Tasbih berbahan cemara dengan tekstur halus dan aroma khas.</p>'],
            ['title' => 'Tasbih Kuku', 'description' => '<p>Tasbih kuku awet dengan butiran rapi, cocok untuk jamaah yang aktif berdzikir.</p>'],
        ],
    ];

    public function run(): void
    {
        foreach ($this->catalog as $slug => $items) {
            $service = Service::where('slug', $slug)->first();
            if (! $service) {
                continue;
            }

            $service->serviceItems()->delete();

            $sort = 1;
            foreach ($items as $item) {
                $service->serviceItems()->create([
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'image' => null,
                    'sort' => $sort,
                    'status' => true,
                ]);
                $sort++;
            }
        }
    }
}