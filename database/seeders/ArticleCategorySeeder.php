<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Panduan Umroh', 'slug' => 'panduan-umroh', 'sort' => 1],
            ['name' => 'Doa & Dzikir', 'slug' => 'doa-dzikir', 'sort' => 2],
            ['name' => 'Tips Perjalanan', 'slug' => 'tips-perjalanan', 'sort' => 3],
            ['name' => 'Berita Umroh', 'slug' => 'berita-umroh', 'sort' => 4],
            ['name' => 'Kuliner & Oleh-oleh', 'slug' => 'kuliner-oleh-oleh', 'sort' => 5],
        ];

        foreach ($categories as $cat) {
            ArticleCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
