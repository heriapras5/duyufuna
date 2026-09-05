<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hotel', 'slug' => 'hotel', 'icon' => '🏨', 'subtitle' => 'Akomodasi terbaik di Mekkah & Madinah', 'sort' => 1, 'layout' => 'city'],
            ['name' => 'Visa', 'slug' => 'visa', 'icon' => '🛂', 'subtitle' => 'Proses cepat & aman', 'sort' => 2],
            ['name' => 'Transportasi', 'slug' => 'transportasi', 'icon' => '🚐', 'subtitle' => 'Nyaman & terpercaya', 'sort' => 3, 'layout' => 'products'],
            ['name' => 'Handling', 'slug' => 'handling', 'icon' => '🛎️', 'subtitle' => 'Layanan profesional sejak mendarat', 'sort' => 4],
            ['name' => 'Catering', 'slug' => 'catering', 'icon' => '🍽️', 'subtitle' => 'Menu berkualitas & higienis', 'sort' => 6],
            ['name' => 'Laundry', 'slug' => 'laundry', 'icon' => '🧺', 'subtitle' => 'Bersih, wangi, & cepat', 'sort' => 7],
            ['name' => 'Buggy Car', 'slug' => 'buggy-car', 'icon' => '🚗', 'subtitle' => 'Fleksibel & nyaman', 'sort' => 8],
            ['name' => 'Jastip Viral', 'slug' => 'jastip-viral', 'icon' => '🛍️', 'subtitle' => 'Oleh-oleh kekinian', 'sort' => 9, 'layout' => 'products'],
            ['name' => 'Kursi Roda Umroh', 'slug' => 'kursi-roda-umroh', 'icon' => '♿', 'subtitle' => 'Layanan khusus jamaah lansia', 'sort' => 10],
            ['name' => 'Fotografer', 'slug' => 'fotografer', 'icon' => '📸', 'subtitle' => 'Fasilitas Grup & Individu', 'sort' => 11],
            ['name' => 'Penukaran Uang', 'slug' => 'penukaran-uang', 'icon' => '💱', 'subtitle' => 'Rate terbaik & terpercaya', 'sort' => 12],
            ['name' => 'Muthawif', 'slug' => 'muthawif', 'icon' => '🕋', 'subtitle' => 'Pembimbing ibadah', 'sort' => 13],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
