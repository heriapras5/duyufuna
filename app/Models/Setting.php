<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('setting'));
    }

    protected $fillable = [
        'logo', 'favicon', 'website_name', 'tagline',
        'whatsapp', 'email', 'address',
        'wa_message',
        'banner_image', 'banner_badge', 'banner_title', 'banner_cta_text', 'banner_cta_url',
        'greeting_image', 'greeting_title', 'greeting_subtitle', 'greeting_text',
        'hero_subtitle',
        'about_banner', 'about_image', 'about_title', 'about_body',
        'why_label', 'why_title', 'why_subtitle',
        'testimonial_label', 'testimonial_title', 'testimonial_subtitle',
        'cta_pill', 'cta_title', 'cta_subtitle', 'cta_button',
        'services_page_title', 'services_page_subtitle',
        'galeri_page_title', 'galeri_page_subtitle',
        'testimoni_page_title', 'testimoni_page_subtitle',
        'faq_page_title', 'faq_page_subtitle',
        'artikel_page_title', 'artikel_page_subtitle',
        'footer_text', 'footer_contact_heading', 'footer_links_heading', 'footer_links', 'footer_copyright',
        'og_image',
        'og_title', 'og_description', 'og_type', 'og_site_name',
        'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image',
        'canonical_url', 'robots',
        'google_site_verification', 'bing_site_verification',
        'google_analytics_id', 'google_tag_manager_id',
        'schema_enabled', 'org_name', 'org_logo', 'org_phone', 'org_email', 'org_address', 'org_geo_lat', 'org_geo_lng',
        'sitemap_enabled',
        'seo_title', 'seo_description', 'seo_keywords',
        'social_instagram', 'social_facebook', 'social_youtube', 'social_tiktok',
    ];

    protected function casts(): array
    {
        return [
            'schema_enabled' => 'boolean',
            'sitemap_enabled' => 'boolean',
        ];
    }
}
