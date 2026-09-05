<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Regresi untuk halaman Fotografer:
 * - tanggal kegiatan wajib diisi (422 bila kosong),
 * - request valid menghasilkan link WhatsApp berisi tanggal + harga,
 * - admin form item mendukung galeri.
 */
class FotograferTest extends TestCase
{
    use RefreshDatabase;

    private function seedFotografer(): array
    {
        $category = Category::create([
            'name' => 'Fotografer', 'slug' => 'fotografer', 'icon' => '📸',
            'page_type' => 'form', 'item_label' => 'Kegiatan',
        ]);
        $service = Service::create([
            'category_id' => $category->id, 'title' => 'Fotografer',
            'slug' => 'fotografer', 'status' => true,
        ]);
        foreach ([['Ziarah Nabawi', 300], ['Raudoh Laki-laki', 200]] as $i => [$title, $sar]) {
            ServiceItem::create([
                'service_id' => $service->id, 'title' => $title,
                'price_per_night' => $sar, 'sort' => $i + 1, 'status' => true,
            ]);
        }

        return [$category, $service];
    }

    public function test_request_kegiatan_tanpa_tanggal_ditolak(): void
    {
        [$category, $service] = $this->seedFotografer();
        $item = $service->serviceItems()->first();

        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
            ->postJson(route('customer.store'), [
                'category_id' => $category->id,
                'service_id' => $service->id,
                'item_id' => $item->id,
                'nama' => 'Budi', 'no_hp' => '08123456789',
                'unit_price' => 300, 'currency' => 'SAR', 'unit_label' => 'kegiatan',
            ])->assertStatus(422)->assertJsonValidationErrors(['pickup_date']);
    }

    public function test_request_kegiatan_dengan_tanggal_menghasilkan_link_wa(): void
    {
        [$category, $service] = $this->seedFotografer();
        $item = $service->serviceItems()->first();

        $res = $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
            ->postJson(route('customer.store'), [
                'category_id' => $category->id,
                'service_id' => $service->id,
                'item_id' => $item->id,
                'nama' => 'Budi', 'no_hp' => '08123456789',
                'unit_price' => 300, 'currency' => 'SAR', 'unit_label' => 'kegiatan',
                'pickup_date' => '2026-10-01',
            ])->assertOk();

        $url = $res->json('redirect_url');
        $this->assertStringContainsString('wa.me', $url);
        $decoded = rawurldecode($url);
        $this->assertStringContainsString('Tanggal Kegiatan', $decoded);
        $this->assertStringContainsString('SAR 300', $decoded);
    }

    public function test_admin_form_item_mendukung_galeri(): void
    {
        [$category, $service] = $this->seedFotografer();
        $item = $service->serviceItems()->first();
        $admin = User::factory()->create(['role' => 'admin', 'is_admin' => true]);

        $this->actingAs($admin)
            ->get(route('admin.services.items', $service))
            ->assertOk()->assertSee('Galeri Kegiatan');

        $this->actingAs($admin)
            ->get(route('admin.services.items.edit', $item))
            ->assertOk()->assertSee('Galeri Kegiatan');
    }
}
