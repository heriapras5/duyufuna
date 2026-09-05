<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Services\HtmlNormalizer;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormItemController extends Controller
{
    public function index(Service $service)
    {
        $category = $service->category;
        abort_unless($category->pageType() === 'form', 404);

        $service->load('serviceItems');

        // Muthawif, Laundry, Buggy, Kursi Roda & Fotografer: halaman daftar khusus (item di atas, tambah via tombol).
        if (in_array($category->slug, ['muthawif', 'laundry', 'buggy-car', 'kursi-roda-umroh', 'fotografer'])) {
            return view('admin.services.items_muthawif', compact('category', 'service'));
        }

        return view('admin.services.items', compact('category', 'service'));
    }

    public function create(Service $service)
    {
        $category = $service->category;
        abort_unless($category->pageType() === 'form', 404);

        return view('admin.services.items_create', compact('category', 'service'));
    }

    public function store(Request $request, Service $service)
    {
        $category = $service->category;
        abort_unless($category->pageType() === 'form', 404);

        $isFotografer = $category->slug === 'fotografer';

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'info' => $isFotografer ? 'nullable' : 'nullable|string|max:500',
            'image' => $isFotografer ? 'nullable' : 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery' => 'nullable|array|max:8',
            'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'service_id' => $service->id,
            'title' => $validated['title'],
            'price_per_night' => $validated['price'] ?? null,
            'status' => $request->boolean('status', true),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
            'sort' => $service->serviceItems()->max('sort') + 1,
        ];

        if (! $isFotografer) {
            $data['info'] = trim((string) ($validated['info'] ?? '')) ?: null;
        }

        $galleryDir = $isFotografer ? 'galleries' : 'service-items';

        $gallery = [];
        foreach ($request->file('gallery', []) as $file) {
            $gallery[] = app(ImageService::class)->processAndStore($file, $galleryDir, 1200);
        }
        if ($gallery !== []) {
            $data['gallery'] = $gallery;
        }

        if (! $isFotografer && $request->hasFile('image')) {
            $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'service-items', 1200);
        }

        $service->serviceItems()->create($data);

        return redirect()
            ->route('admin.services.items', $service)
            ->with('success', 'Item berhasil ditambahkan.');
    }

    public function edit(ServiceItem $item)
    {
        $service = $item->service;
        $category = $service->category;
        abort_unless($category->pageType() === 'form', 404);

        return view('admin.services.items_form', compact('category', 'service', 'item'));
    }

    public function update(Request $request, ServiceItem $item)
    {
        $service = $item->service;
        $category = $service->category;
        abort_unless($category->pageType() === 'form', 404);

        $isFotografer = $category->slug === 'fotografer';

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'info' => $isFotografer ? 'nullable' : 'nullable|string|max:500',
            'image' => $isFotografer ? 'nullable' : 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery' => 'nullable|array|max:8',
            'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_gallery' => 'nullable|array',
            'status' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'price_per_night' => $validated['price'] ?? null,
            'status' => $request->boolean('status', $item->status),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'wa_message' => $validated['wa_message'] ?? null,
        ];

        if (! $isFotografer) {
            $data['info'] = trim((string) ($validated['info'] ?? '')) ?: null;

            if ($request->hasFile('image')) {
                $data['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'service-items', 1200);
                if ($item->image) {
                    Storage::disk('public')->delete($item->image);
                }
            } elseif ($request->input('remove_image')) {
                if ($item->image) {
                    Storage::disk('public')->delete($item->image);
                }
                $data['image'] = null;
            }
        }

        $data['gallery'] = $this->processGallery($request, $item);

        $item->update($data);

        return redirect()
            ->route('admin.services.items', $service)
            ->with('success', 'Item berhasil diperbarui.');
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

        // Foto galeri kegiatan fotografer disimpan di folder galleries/.
        $galleryDir = ($item?->service?->category?->slug ?? '') === 'fotografer'
            ? 'galleries'
            : 'service-items';

        foreach ($request->file('gallery', []) as $file) {
            $remaining[] = app(ImageService::class)->processAndStore($file, $galleryDir, 1200);
        }

        return array_values(array_unique($remaining)) ?: null;
    }

    public function destroy(ServiceItem $item)
    {
        $service = $item->service;
        $category = $service->category;
        abort_unless($category->pageType() === 'form', 404);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        foreach ((array) $item->gallery as $path) {
            Storage::disk('public')->delete($path);
        }
        $item->delete();

        return redirect()
            ->route('admin.services.items', $service)
            ->with('success', 'Item berhasil dihapus.');
    }
}