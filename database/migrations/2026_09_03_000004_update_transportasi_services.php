<?php

use App\Models\Banner;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected array $vehicles = [
        'Camry'    => ['icon' => '🚗', 'desc' => 'Sedan nyaman untuk perjalanan pribadi, cocok untuk 1-3 penumpang.', 'min_sar' => 210],
        'Ford'     => ['icon' => '🚙', 'desc' => 'SUV tangguh dengan kabin luas, ideal perjalanan keluarga.', 'min_sar' => 310],
        'Lexus'    => ['icon' => '🚘', 'desc' => 'Mewah dan premium untuk pengalaman perjalanan eksklusif.', 'min_sar' => 360],
        'Traverse' => ['icon' => '🚙', 'desc' => 'SUV 7-penumpang lega untuk perjalanan grup kecil.', 'min_sar' => 360],
        'GMC'      => ['icon' => '🚐', 'desc' => 'Van besar cocok untuk rombongan dengan banyak bagasi.', 'min_sar' => 360],
        'Staria'   => ['icon' => '🚐', 'desc' => 'Minibus modern dengan kabin premium untuk 7 penumpang.', 'min_sar' => 310],
        'Hiace'    => ['icon' => '🚌', 'desc' => 'Minibus lega untuk perjalanan keluarga atau grup 11 pax.', 'min_sar' => 310],
        'Coaster'  => ['icon' => '🚌', 'desc' => 'Bus medium untuk rombongan besar dengan kenyamanan penuh.', 'min_sar' => 310],
        'Bus'      => ['icon' => '🚌', 'desc' => 'Bus besar kapasitas 49 pax untuk perjalanan rombongan.', 'min_sar' => 260],
    ];

    public function up(): void
    {
        $catId = DB::table('categories')->where('slug', 'transportasi')->value('id');
        if (! $catId) {
            return;
        }

        // Delete old services + items + banners
        $oldIds = DB::table('services')->where('category_id', $catId)->pluck('id');
        foreach ($oldIds as $oldId) {
            // Delete item images
            $itemImages = DB::table('service_items')->where('service_id', $oldId)->pluck('image');
            foreach ($itemImages as $img) {
                if ($img) { try { \Illuminate\Support\Facades\Storage::disk('public')->delete($img); } catch (\Exception $e) {} }
            }
            DB::table('service_items')->where('service_id', $oldId)->delete();

            // Delete banner images
            $banners = Banner::where('service_id', $oldId)->get();
            foreach ($banners as $b) {
                if ($b->image) { try { \Illuminate\Support\Facades\Storage::disk('public')->delete($b->image); } catch (\Exception $e) {} }
                $b->delete();
            }

            // Delete service image
            $svc = Service::find($oldId);
            if ($svc && $svc->image) {
                try { \Illuminate\Support\Facades\Storage::disk('public')->delete($svc->image); } catch (\Exception $e) {}
            }
            Service::where('id', $oldId)->delete();
        }

        // Create 9 new services
        foreach ($this->vehicles as $name => $info) {
            $slug = 'transport-' . strtolower($name);

            Service::create([
                'category_id' => $catId,
                'title' => $name,
                'slug' => $slug,
                'short_description' => $info['desc'],
                'icon' => $info['icon'],
                'price_sar' => $info['min_sar'],
                'status' => true,
            ]);
        }
    }

    public function down(): void
    {
        $catId = DB::table('categories')->where('slug', 'transportasi')->value('id');
        if (! $catId) return;

        // Revert: delete 9 services, restore 3 original
        DB::table('services')->where('category_id', $catId)->delete();

        $originals = [
            ['title' => 'Bus Shalawat', 'slug' => 'transportasi-bus-shalawat', 'short_description' => 'Bus antar-jemput dari hotel ke Masjidil Haram', 'price' => 150000, 'icon' => '🚌'],
            ['title' => 'Sewa Bus 24 Jam', 'slug' => 'transportasi-bus-24jam', 'short_description' => 'Sewa bus khusus untuk kebutuhan perjalanan grup', 'price' => 3500000, 'icon' => '🚌'],
            ['title' => 'Toyota Hiace', 'slug' => 'transportasi-hiace', 'short_description' => 'Mobil Hiace untuk perjalanan keluarga / grup kecil', 'price' => 1800000, 'icon' => '🚐'],
        ];

        foreach ($originals as $data) {
            $data['category_id'] = $catId;
            $data['status'] = true;
            Service::create($data);
        }
    }
};