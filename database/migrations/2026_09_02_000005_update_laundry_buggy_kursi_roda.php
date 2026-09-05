<?php

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->text('info')->nullable()->after('description');
        });

        $this->syncService('laundry-kilat', [
            'Laundry 1–5 kg' => ['price' => 15, 'info' => 'Waktu pengerjaan ± 24 jam · Antar-jemput ke kamar hotel'],
            'Laundry 5–10 kg' => ['price' => 13, 'info' => 'Waktu pengerjaan ± 24 jam · Antar-jemput ke kamar hotel'],
        ]);

        $this->syncService('buggy-car-haram', [
            'Tawaf' => ['price' => 110, 'info' => 'Layanan buggy antar-jemput mengelilingi Ka\'bah'],
            'Sa\'i' => ['price' => 110, 'info' => 'Layanan buggy antar-jemput Safa–Marwah'],
            'Umroh (Tawaf + Sa\'i)' => ['price' => 220, 'info' => 'Paket lengkap Tawaf + Sa\'i, lebih hemat'],
        ]);

        $this->syncService('kursi-roda-sewa', [
            'Tawaf' => ['price' => 150, 'info' => 'Didorong petugas berpengalaman mengelilingi Ka\'bah'],
            'Sa\'i' => ['price' => 150, 'info' => 'Didorong petugas via jalur Safa–Marwah'],
            'Umroh (Tawaf + Sa\'i)' => ['price' => 350, 'info' => 'Paket lengkap dengan pendampingan petugas'],
        ]);
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn('info');
        });
    }

    private function syncService(string $serviceSlug, array $newItems): void
    {
        $service = Service::where('slug', $serviceSlug)->first();
        if (! $service) {
            return;
        }

        $oldTitles = $service->serviceItems()->pluck('title')->all();

        foreach ($newItems as $title => $data) {
            ServiceItem::updateOrCreate(
                ['service_id' => $service->id, 'title' => $title],
                [
                    'description' => null,
                    'price_per_night' => $data['price'],
                    'info' => $data['info'],
                    'status' => true,
                ]
            );
        }

        $keep = array_keys($newItems);
        foreach ($oldTitles as $oldTitle) {
            if (! in_array($oldTitle, $keep, true)) {
                ServiceItem::where('service_id', $service->id)
                    ->where('title', $oldTitle)
                    ->delete();
            }
        }

        $sort = 1;
        foreach ($newItems as $title => $data) {
            ServiceItem::where('service_id', $service->id)
                ->where('title', $title)
                ->update(['sort' => $sort]);
            $sort++;
        }
    }
};
