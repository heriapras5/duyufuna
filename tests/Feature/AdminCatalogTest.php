<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCatalogTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin', 'is_admin' => true]);
    }

    private function catalogCategory(): Category
    {
        return Category::create([
            'name' => 'Hotel',
            'slug' => 'hotel',
            'is_catalog' => true,
            'group_label' => 'Kota',
            'item_label' => 'Hotel',
        ]);
    }

    public function test_catalog_category_shows_group_cards_and_redirects_from_show(): void
    {
        $user = $this->admin();
        $category = $this->catalogCategory();
        $service = Service::create(['category_id' => $category->id, 'title' => 'Mekkah', 'slug' => 'mekkah', 'status' => true]);

        $this->actingAs($user)
            ->get(route('admin.categories.show', $category))
            ->assertRedirect(route('admin.catalog.groups', $category));

        $this->actingAs($user)
            ->get(route('admin.catalog.groups', $category))
            ->assertOk()
            ->assertSee('Mekkah')
            ->assertSee('Kota');

        $this->actingAs($user)
            ->get(route('admin.catalog.items', [$category, $service]))
            ->assertOk()
            ->assertSee('Mekkah');
    }

    public function test_non_catalog_category_keeps_default_show_view(): void
    {
        $user = $this->admin();
        $category = Category::create(['name' => 'Visa', 'slug' => 'visa', 'is_catalog' => false]);

        $this->actingAs($user)
            ->get(route('admin.categories.show', $category))
            ->assertOk();
    }

    public function test_group_crud_with_lightweight_form(): void
    {
        $user = $this->admin();
        $category = $this->catalogCategory();

        $this->actingAs($user)
            ->get(route('admin.catalog.groups.create', $category))
            ->assertOk()
            ->assertSee('Nama Kota');

        $this->actingAs($user)
            ->post(route('admin.catalog.groups.store', $category), [
                'title' => 'Madinah',
                'description' => 'Kota Madinah',
                'status' => 1,
            ])
            ->assertRedirect(route('admin.catalog.groups', $category));

        $group = Service::where('category_id', $category->id)->where('title', 'Madinah')->first();
        $this->assertNotNull($group);
        $this->assertTrue($group->status);

        $this->actingAs($user)
            ->put(route('admin.catalog.groups.update', [$category, $group]), [
                'title' => 'Madinah Updated',
                'description' => 'Baru',
                'status' => 0,
            ])
            ->assertRedirect(route('admin.catalog.groups', $category));

        $this->assertDatabaseHas('services', [
            'id' => $group->id,
            'title' => 'Madinah Updated',
            'slug' => 'madinah-updated',
            'status' => 0,
        ]);

        $this->actingAs($user)
            ->delete(route('admin.catalog.groups.destroy', [$category, $group]))
            ->assertRedirect(route('admin.catalog.groups', $category));

        $this->assertDatabaseMissing('services', ['id' => $group->id]);
    }

    public function test_item_crud_on_catalog_page(): void
    {
        $user = $this->admin();
        $category = $this->catalogCategory();
        $service = Service::create(['category_id' => $category->id, 'title' => 'Mekkah', 'slug' => 'mekkah', 'status' => true]);

        $this->actingAs($user)
            ->post(route('admin.catalog.items.store', [$category, $service]), [
                'title' => 'Hotel Hilton',
                'description' => 'Bintang 5 dekat Masjidil Haram',
            ])
            ->assertRedirect(route('admin.catalog.items', [$category, $service]));

        $item = ServiceItem::where('service_id', $service->id)->where('title', 'Hotel Hilton')->first();
        $this->assertNotNull($item);
        $this->assertTrue($item->status);

        $this->actingAs($user)
            ->put(route('admin.catalog.items.update', $item), [
                'title' => 'Hotel Hilton Updated',
                'description' => 'Baru',
                'status' => 0,
            ])
            ->assertRedirect(route('admin.catalog.items', [$category, $service]));

        $this->assertDatabaseHas('service_items', [
            'id' => $item->id,
            'title' => 'Hotel Hilton Updated',
            'status' => 0,
        ]);

        $this->actingAs($user)
            ->delete(route('admin.catalog.items.destroy', $item))
            ->assertRedirect(route('admin.catalog.items', [$category, $service]));

        $this->assertDatabaseMissing('service_items', ['id' => $item->id]);
    }

    public function test_groups_aborts_for_non_catalog_category(): void
    {
        $user = $this->admin();
        $category = Category::create(['name' => 'Visa', 'slug' => 'visa', 'is_catalog' => false]);

        $this->actingAs($user)
            ->get(route('admin.catalog.groups', $category))
            ->assertNotFound();
    }
}
