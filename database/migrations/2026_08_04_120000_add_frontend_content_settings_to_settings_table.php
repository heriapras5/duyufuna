<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const COLUMNS = [
        'og_image',
        'hero_subtitle',
        'greeting_title',
        'greeting_text',
        'why_label',
        'why_title',
        'why_subtitle',
        'testimonial_label',
        'testimonial_title',
        'testimonial_subtitle',
        'cta_pill',
        'cta_title',
        'cta_subtitle',
        'cta_button',
        'services_page_title',
        'services_page_subtitle',
        'galeri_page_title',
        'galeri_page_subtitle',
        'testimoni_page_title',
        'testimoni_page_subtitle',
        'faq_page_title',
        'faq_page_subtitle',
        'artikel_page_title',
        'artikel_page_subtitle',
        'footer_contact_heading',
        'footer_links_heading',
        'footer_links',
        'footer_copyright',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            foreach (self::COLUMNS as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->text('og_image')->nullable()->after('favicon');
            $table->text('hero_subtitle')->nullable()->after('banner_cta_url');
            $table->text('greeting_title')->nullable()->after('greeting_image');
            $table->text('greeting_text')->nullable()->after('greeting_title');
            $table->text('why_label')->nullable()->after('greeting_text');
            $table->text('why_title')->nullable()->after('why_label');
            $table->text('why_subtitle')->nullable()->after('why_title');
            $table->text('testimonial_label')->nullable()->after('trust_badge_4_text');
            $table->text('testimonial_title')->nullable()->after('testimonial_label');
            $table->text('testimonial_subtitle')->nullable()->after('testimonial_title');
            $table->text('cta_pill')->nullable()->after('testimonial_subtitle');
            $table->text('cta_title')->nullable()->after('cta_pill');
            $table->text('cta_subtitle')->nullable()->after('cta_title');
            $table->text('cta_button')->nullable()->after('cta_subtitle');
            $table->text('services_page_title')->nullable()->after('cta_button');
            $table->text('services_page_subtitle')->nullable()->after('services_page_title');
            $table->text('galeri_page_title')->nullable()->after('services_page_subtitle');
            $table->text('galeri_page_subtitle')->nullable()->after('galeri_page_title');
            $table->text('testimoni_page_title')->nullable()->after('galeri_page_subtitle');
            $table->text('testimoni_page_subtitle')->nullable()->after('testimoni_page_title');
            $table->text('faq_page_title')->nullable()->after('testimoni_page_subtitle');
            $table->text('faq_page_subtitle')->nullable()->after('faq_page_title');
            $table->text('artikel_page_title')->nullable()->after('faq_page_subtitle');
            $table->text('artikel_page_subtitle')->nullable()->after('artikel_page_title');
            $table->text('footer_contact_heading')->nullable()->after('footer_text');
            $table->text('footer_links_heading')->nullable()->after('footer_contact_heading');
            $table->text('footer_links')->nullable()->after('footer_links_heading');
            $table->text('footer_copyright')->nullable()->after('footer_links');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            foreach (self::COLUMNS as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
