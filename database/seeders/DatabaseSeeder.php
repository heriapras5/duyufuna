<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin',
                'email' => 'admin@duyufuna.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'role' => 'super_admin',
            ]
        );

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'website_name' => 'DUYUFUNA',
                'tagline' => 'MELAYANI TAMU ALLAH, SEPENUH HATI',
                'whatsapp' => '6281234567890',
                'email' => 'info@duyufuna.com',
                'address' => 'Jakarta, Indonesia',
            ]
        );

        $this->call(MenuSeeder::class);
        $this->call(ArticleCategorySeeder::class);

        $this->call(DemoSeeder::class);
        $this->call(CategoryContentSeeder::class);
        $this->call(CatalogSeeder::class);
        $this->call(FrontendDummySeeder::class);
    }
}
