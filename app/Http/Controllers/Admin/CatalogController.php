<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Services\HtmlNormalizer;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function root()
    {
        $category = Category::orderBy('sort')->first();

        if ($category) {
            return redirect()->route('admin.catalog.groups', $category);
        }

        return redirect()->route('admin.categories.index');
    }

    public function groups(Category $category)
    {
        abort_unless($category->isCatalog(), 404);

        $services = $category->services()
            ->withCount('serviceItems')
            ->orderBy('title')
            ->get();

        // Kategori dengan hanya satu service (mis. Visa) langsung ke halaman items
        if ($services->count() === 1) {
            return redirect()->route('admin.catalog.items', [$category, $services->first()]);
        }

        return view('admin.categories.show_catalog', compact('category', 'services'));
    }

    public function groupCreate(Category $category)
    {
        abort_unless($category->isCatalog(), 404);

        $service = new Service(['category_id' => $category->id]);

        return view('admin.catalog.groups_form', compact('category', 'service'));
    }

    public function groupStore(Request $request, Category $category)
    {
        abort_unless($category->isCatalog(), 404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'category_id' => $category->id,
            'title' => $validated['title'],
            'short_description' => trim((string) ($validated['short_description'] ?? '')) ?: null,
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'slug' => app(SlugService::class)->make($validated['title'], 'services'),
            'status' => $request->boolean('status', true),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'services');
        }

        Service::create($data);

        return redirect()
            ->route('admin.catalog.groups', $category)
            ->with('success', $category->groupLabel() . ' berhasil ditambahkan.');
    }

    public function groupEdit(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        return view('admin.catalog.groups_form', compact('category', 'service'));
    }

    public function groupUpdate(Request $request, Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'short_description' => trim((string) ($validated['short_description'] ?? '')) ?: null,
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'slug' => app(SlugService::class)->make($validated['title'], 'services', $service->id),
            'status' => $request->boolean('status', $service->status),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'services');
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        } elseif ($request->input('remove_image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = null;
        }

        $service->update($data);

        return redirect()
            ->route('admin.catalog.groups', $category)
            ->with('success', $category->groupLabel() . ' berhasil diperbarui.');
    }

    public function groupDestroy(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        foreach ($service->banners as $banner) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->delete();
        }
        foreach ($service->serviceItems as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
        }
        $service->delete();

        return redirect()
            ->route('admin.catalog.groups', $category)
            ->with('success', $category->groupLabel() . ' berhasil dihapus.');
    }

    public function items(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $service->load('serviceItems');

        return view('admin.catalog.items', compact('category', 'service'))
            ->with('hasMultipleServices', $category->services()->count() > 1);
    }

    public function itemEdit(ServiceItem $item)
    {
        $service = $item->service;
        $category = $service->category;

        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        return view('admin.catalog.items_form', compact('category', 'service', 'item'));
    }

    public function itemCreate(Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        return view('admin.catalog.items_create', compact('category', 'service'));
    }

    public function storeItem(Request $request, Category $category, Service $service)
    {
        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $validated = $request->validate($this->itemRules($category));
        $data = $this->itemData($request, $category, null, $validated);
        $data['sort'] = $service->serviceItems()->max('sort') + 1;

        $service->serviceItems()->create($data);

        return redirect()
            ->route('admin.catalog.items', [$category, $service])
            ->with('success', $category->itemLabel() . ' berhasil ditambahkan.');
    }

    public function updateItem(Request $request, ServiceItem $item)
    {
        $service = $item->service;
        $category = $service->category;

        abort_unless($category->isCatalog(), 404);
        abort_unless($service->category_id === $category->id, 404);

        $validated = $request->validate($this->itemRules($category));
        $data = $this->itemData($request, $category, $item, $validated);

        $item->update($data);

        return redirect()
            ->route('admin.catalog.items', [$item->service->category_id, $item->service_id])
            ->with('success', 'Item berhasil diperbarui.');
    }

    protected function itemRules(Category $category): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ];

        if ($category->isHotel()) {
            $rules += [
                'star' => 'nullable|integer|between:1,5',
                'distance' => 'nullable|string|max:100',
                'price_text' => 'nullable|string|max:50',
                'map_link' => 'nullable|string|max:500',
                'benefit' => 'nullable|string',
                'area' => 'nullable|string|max:255',
                'walk_time' => 'nullable|string|max:100',
                'room_types' => 'nullable|string|max:500',
                'recommendation' => 'nullable|string',
                'gallery' => 'nullable|array',
                'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
                'remove_gallery' => 'nullable|array',
            ];
        }

        if ($category->slug === 'visa') {
            $rules['price_text'] = 'nullable|string|max:50';
        }

        if (in_array($category->slug, ['jastip-viral', 'catering'])) {
            $rules['price'] = 'nullable|numeric|min:0';
        }

        if ($category->isHandling()) {
            $rules += [
                'tagline' => 'nullable|string|max:255',
                'benefit' => 'nullable|string',
                'pax_prices' => 'nullable|array',
                'pax_prices.*.min' => 'nullable|integer|min:1',
                'pax_prices.*.max' => 'nullable|integer|min:1',
                'pax_prices.*.price' => 'nullable|numeric|min:0',
            ];
        }

        return $rules;
    }

    protected function itemData(Request $request, Category $category, ?ServiceItem $item, array $validated): array
    {
        $data = [
            'title' => $validated['title'],
            'description' => HtmlNormalizer::clean($validated['description'] ?? null),
            'status' => $item
                ? ($request->has('status') ? (bool) $request->input('status') : $item->status)
                : true,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        $parsed = $this->parsePrice($validated['price_text'] ?? null);

        if ($category->slug === 'visa') {
            if (! $item || $item->title !== $validated['title']) {
                $data['slug'] = app(SlugService::class)->make($validated['title'], 'service_items', $item?->id);
            }
            $data['price_per_night'] = $parsed['min'];
            $data['price_max'] = $parsed['max'];
        }

        if (in_array($category->slug, ['jastip-viral', 'catering'])) {
            $data['price_per_night'] = $validated['price'] ?? null;
        }

        if ($category->isHotel()) {
            if (! $item || $item->title !== $validated['title']) {
                $data['slug'] = app(SlugService::class)->make($validated['title'], 'service_items', $item?->id);
            }
            $data += [
                'star' => $validated['star'] ?? null,
                'distance' => $validated['distance'] ?? null,
                'price_per_night' => $parsed['min'],
                'price_max' => $parsed['max'],
                'map_link' => $validated['map_link'] ?? null,
                'benefit' => trim((string) ($validated['benefit'] ?? '')) ?: null,
                'area' => trim((string) ($validated['area'] ?? '')) ?: null,
                'walk_time' => trim((string) ($validated['walk_time'] ?? '')) ?: null,
                'room_types' => trim((string) ($validated['room_types'] ?? '')) ?: null,
                'recommendation' => HtmlNormalizer::clean($validated['recommendation'] ?? null),
            ];
        }

        if ($category->isHandling()) {
            if (! $item || $item->title !== $validated['title']) {
                $data['slug'] = app(SlugService::class)->make($validated['title'], 'service_items', $item?->id);
            }
            $data += [
                'tagline' => trim((string) ($validated['tagline'] ?? '')) ?: null,
                'benefit' => trim((string) ($validated['benefit'] ?? '')) ?: null,
                'pax_prices' => $this->normalizePaxPrices($validated['pax_prices'] ?? null),
            ];
        }

        if ($request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'service-items', 1200);
            if ($item?->image) {
                Storage::disk('public')->delete($item->image);
            }
        } elseif ($request->input('remove_image')) {
            if ($item?->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = null;
        }

        if ($category->isHotel()) {
            $data['gallery'] = $this->processGallery($request, $item);
        }

        return $data;
    }

    protected function processGallery(Request $request, ?ServiceItem $item): ?array
    {
        $current = is_array($item?->gallery) ? $item->gallery : [];
        $removed = $request->input('remove_gallery', []);
        $remaining = array_values(array_filter($current, fn ($path) => ! in_array($path, $removed, true)));

        foreach ($removed as $path) {
            if (is_string($path) && in_array($path, $current, true)) {
                Storage::disk('public')->delete($path);
            }
        }

        foreach ($request->file('gallery', []) as $file) {
            $remaining[] = app(ImageService::class)->processAndStore($file, 'service-items', 1200);
        }

        return array_values(array_unique($remaining)) ?: null;
    }

    public function destroyItem(ServiceItem $item)
    {
        $service = $item->service;
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        foreach (is_array($item->gallery) ? $item->gallery : [] as $path) {
            if (is_string($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $item->delete();

        return redirect()
            ->route('admin.catalog.items', [$service->category_id, $service->id])
            ->with('success', 'Item berhasil dihapus.');
    }

    protected function parsePrice(?string $text): array
    {
        $text = trim((string) $text);
        if ($text === '') {
            return ['min' => null, 'max' => null];
        }

        $text = str_replace(' ', '', $text);

        // Normalisasi angka: titik/koma diikuti tepat 3 digit = pemisah ribuan (dihapus);
        // diikuti 1-2 digit = desimal (ganti ke titik). Mencegah "300.00" terbaca sebagai 30000.
        $text = preg_replace('/[.,](\d{3})(?=(\D|$))/', '$1', $text);
        $text = preg_replace('/[.,](\d{1,2})(?=(\D|$))/', '.$1', $text);

        if (preg_match('/(\d+(?:\.\d+)?)\s*[-–]\s*(\d+(?:\.\d+)?)/', $text, $m)) {
            return [
                'min' => (float) $m[1],
                'max' => (float) $m[2],
            ];
        }

        if (preg_match('/(\d+(?:\.\d+)?)/', $text, $m)) {
            return [
                'min' => (float) $m[1],
                'max' => null,
            ];
        }

        return ['min' => null, 'max' => null];
    }

    protected function normalizePaxPrices(?array $tiers): ?array
    {
        if (empty($tiers)) {
            return null;
        }

        $normalized = [];
        foreach ($tiers as $tier) {
            $min = isset($tier['min']) && $tier['min'] !== '' ? (int) $tier['min'] : null;
            $max = isset($tier['max']) && $tier['max'] !== '' ? (int) $tier['max'] : null;
            $price = isset($tier['price']) && $tier['price'] !== '' ? (float) $tier['price'] : null;

            if ($min !== null && $max !== null && $price !== null) {
                $normalized[] = ['min' => $min, 'max' => $max, 'price' => $price];
            }
        }

        return ! empty($normalized) ? $normalized : null;
    }
}