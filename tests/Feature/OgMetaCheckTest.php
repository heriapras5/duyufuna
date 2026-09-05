<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OgMetaCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_share_meta_uses_admin_settings(): void
    {
        Setting::create([
            'website_name' => 'DUYUFUNA',
            'tagline' => 'Melayani Tamu Allah, Sepenuh Hati',
            'seo_description' => 'Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.',
        ]);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('<meta property="og:title" content="DUYUFUNA">', $html);
        $this->assertStringContainsString('Melayani Tamu Allah, Sepenuh Hati.', $html);
        $this->assertStringContainsString('Layanan perjalanan umroh dan haji', $html);
        $this->assertStringContainsString('<meta property="og:locale" content="id_ID">', $html);
        $this->assertStringContainsString('<meta property="og:site_name" content="DUYUFUNA">', $html);
        // URL absolut (APP_URL http://localhost di test env), bukan relatif /storage
        $this->assertMatchesRegularExpression('#<meta property="og:url" content="https?://[^"]+">#', $html);
    }

    public function test_homepage_renders_without_setting_row(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_og_image_is_absolute_with_real_dimensions(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');
        \Illuminate\Support\Facades\Storage::disk('public')->put('logo-test.png', $png);
        Setting::create(['website_name' => 'DUYUFUNA', 'logo' => 'logo-test.png']);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('#<meta property="og:image" content="https?://[^"]+">#', $html);
        $this->assertStringContainsString('<meta property="og:image:width" content="1">', $html);
        $this->assertStringContainsString('<meta property="og:image:height" content="1">', $html);
    }
}
