<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SeoSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create([
                'website_name' => 'DUYUFUNA',
                'whatsapp' => '6281293679502',
            ]);
        }
        return view('admin.settings.seo', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_type' => 'nullable|string|max:100',
            'og_site_name' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'twitter_card' => 'nullable|string|max:100',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'canonical_url' => 'nullable|url|max:500',
            'robots' => 'nullable|string|max:100',
            'google_site_verification' => 'nullable|string|max:500',
            'bing_site_verification' => 'nullable|string|max:500',
            'google_analytics_id' => 'nullable|string|max:100',
            'google_tag_manager_id' => 'nullable|string|max:100',
            'schema_enabled' => 'boolean',
            'org_name' => 'nullable|string|max:255',
            'org_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'org_phone' => 'nullable|string|max:100',
            'org_email' => 'nullable|email|max:255',
            'org_address' => 'nullable|string',
            'org_geo_lat' => 'nullable|string|max:50',
            'org_geo_lng' => 'nullable|string|max:50',
            'sitemap_enabled' => 'boolean',
        ]);

        $imageService = app(ImageService::class);
        $imageFields = ['og_image', 'twitter_image', 'org_logo'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $imageService->processAndStore($request->file($field), 'settings', 1200);
                if ($setting->$field) Storage::disk('public')->delete($setting->$field);
            } elseif ($request->input('remove_' . $field)) {
                if ($setting->$field) Storage::disk('public')->delete($setting->$field);
                $validated[$field] = null;
            } else {
                unset($validated[$field]);
            }
        }

        $setting->update($validated);

        Cache::forget('setting');

        return redirect()->route('admin.seo.index')->with('success', 'Pengaturan SEO berhasil diperbarui.');
    }
}
