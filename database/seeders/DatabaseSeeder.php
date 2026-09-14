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
            ['email' => 'superadmin@duyufuna.com'],
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
                'role' => 'super_admin',
            ]
        );

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'website_name' => 'DUYUFUNA',
                'tagline' => 'MELAYANI TAMU ALLAH, SEPENUH HATI',
                'whatsapp' => '6281293679502',
                'email' => 'info@duyufuna.com',
                'address' => 'Jepara, Indonesia',
            ]
        );

        $this->call(MenuSeeder::class);
        $this->call(ArticleCategorySeeder::class);
        $this->call(TransportPriceSeeder::class);

        // Sumber kebenaran konten = produksi (duyufuna.com).
        // Seeder lama (DemoSeeder, CategoryContentSeeder, CatalogSeeder,
        // FrontendDummySeeder, FotograferSeeder) tidak lagi dipanggil —
        // isinya dummy/placeholder yang seluruhnya digantikan ProductionSyncSeeder.
        $this->call(ProductionSyncSeeder::class);
    }
}
