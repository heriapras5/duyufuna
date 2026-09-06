<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Debug419Test extends TestCase
{
    use RefreshDatabase;

    public function test_debug_419_source(): void
    {
        $category = Category::create(['name' => 'Foto', 'slug' => 'foto']);
        $service = Service::create(['category_id' => $category->id, 'title' => 'S', 'slug' => 's', 'status' => true]);
        $item = ServiceItem::create(['service_id' => $service->id, 'title' => 'I', 'status' => true]);

        fwrite(STDERR, "\nAPP_ENV=" . app()->environment() . " runningUnitTests=" . var_export(app()->runningUnitTests(), true) . "\n");

        $this->withoutExceptionHandling()->postJson(route('customer.store'), [
            'category_id' => $category->id,
            'service_id' => $service->id,
            'item_id' => $item->id,
            'nama' => 'Budi', 'no_hp' => '08123456789',
        ]);

        $this->assertTrue(true);
    }
}
