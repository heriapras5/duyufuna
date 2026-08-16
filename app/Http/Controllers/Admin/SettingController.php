<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
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
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'website_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'wa_message' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|file|mimes:ico,png,webp,jpg,jpeg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'banner_badge' => 'nullable|string|max:100',
            'banner_title' => 'nullable|string|max:255',
            'banner_cta_text' => 'nullable|string|max:100',
            'banner_cta_url' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:1000',
            'greeting_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'greeting_title' => 'nullable|string|max:255',
            'greeting_subtitle' => 'nullable|string|max:1000',
            'greeting_text' => 'nullable|string|max:1000',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'about_banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'about_title' => 'nullable|string|max:255',
            'about_body' => 'nullable|string',
            'why_label' => 'nullable|string|max:100',
            'why_title' => 'nullable|string|max:255',
            'why_subtitle' => 'nullable|string|max:1000',
            'testimonial_label' => 'nullable|string|max:100',
            'testimonial_title' => 'nullable|string|max:255',
            'testimonial_subtitle' => 'nullable|string|max:1000',
            'cta_pill' => 'nullable|string|max:100',
            'cta_title' => 'nullable|string|max:255',
            'cta_subtitle' => 'nullable|string|max:1000',
            'cta_button' => 'nullable|string|max:100',
            'services_page_title' => 'nullable|string|max:255',
            'services_page_subtitle' => 'nullable|string|max:1000',
            'galeri_page_title' => 'nullable|string|max:255',
            'galeri_page_subtitle' => 'nullable|string|max:1000',
            'testimoni_page_title' => 'nullable|string|max:255',
            'testimoni_page_subtitle' => 'nullable|string|max:1000',
            'faq_page_title' => 'nullable|string|max:255',
            'faq_page_subtitle' => 'nullable|string|max:1000',
            'artikel_page_title' => 'nullable|string|max:255',
            'artikel_page_subtitle' => 'nullable|string|max:1000',
            'footer_text' => 'nullable|string',
            'footer_contact_heading' => 'nullable|string|max:100',
            'footer_links_heading' => 'nullable|string|max:100',
            'footer_links' => 'nullable|string',
            'footer_copyright' => 'nullable|string|max:500',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'social_instagram' => 'nullable|string|max:255',
            'social_facebook' => 'nullable|string|max:255',
            'social_youtube' => 'nullable|string|max:255',
            'social_tiktok' => 'nullable|string|max:255',
        ]);

        $imageService = app(ImageService::class);
        $imageFields = ['logo', 'favicon', 'banner_image', 'greeting_image', 'about_banner', 'about_image', 'og_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($field === 'favicon') {
                    $validated[$field] = $imageService->processFavicon($request->file($field), 'settings');
                } else {
                    $maxWidth = match ($field) {
                        'logo' => 400,
                        'banner_image' => 1920,
                        'greeting_image' => 600,
                        default => 1200,
                    };
                    $validated[$field] = $imageService->processAndStore($request->file($field), 'settings', $maxWidth, 85, 204800, $field === 'logo');
                }
                if ($setting->$field) Storage::disk('public')->delete($setting->$field);
            } elseif ($request->input('remove_' . $field)) {
                if ($setting->$field) Storage::disk('public')->delete($setting->$field);
                $validated[$field] = null;
            } else {
                unset($validated[$field]);
            }
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
