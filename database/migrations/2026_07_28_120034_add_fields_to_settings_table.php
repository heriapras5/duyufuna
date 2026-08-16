<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('website_name');
            $table->string('banner_image')->nullable()->after('favicon');
            $table->string('banner_badge')->nullable()->after('banner_image');
            $table->string('banner_title')->nullable()->after('banner_badge');
            $table->string('banner_cta_text')->nullable()->after('banner_title');
            $table->string('banner_cta_url')->nullable()->after('banner_cta_text');
            $table->string('greeting_image')->nullable()->after('banner_cta_url');
            $table->string('trust_badge_1_icon')->nullable()->after('greeting_image');
            $table->string('trust_badge_1_text')->nullable()->after('trust_badge_1_icon');
            $table->string('trust_badge_2_icon')->nullable()->after('trust_badge_1_text');
            $table->string('trust_badge_2_text')->nullable()->after('trust_badge_2_icon');
            $table->string('trust_badge_3_icon')->nullable()->after('trust_badge_2_text');
            $table->string('trust_badge_3_text')->nullable()->after('trust_badge_3_icon');
            $table->string('trust_badge_4_icon')->nullable()->after('trust_badge_3_text');
            $table->string('trust_badge_4_text')->nullable()->after('trust_badge_4_icon');
            $table->text('footer_text')->nullable()->after('address');
            $table->string('seo_title')->nullable()->after('footer_text');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->text('seo_keywords')->nullable()->after('seo_description');
            $table->string('social_instagram')->nullable()->after('seo_keywords');
            $table->string('social_facebook')->nullable()->after('social_instagram');
            $table->string('social_youtube')->nullable()->after('social_facebook');
            $table->string('social_tiktok')->nullable()->after('social_youtube');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'tagline', 'banner_image', 'banner_badge', 'banner_title', 'banner_cta_text', 'banner_cta_url',
                'greeting_image',
                'trust_badge_1_icon', 'trust_badge_1_text',
                'trust_badge_2_icon', 'trust_badge_2_text',
                'trust_badge_3_icon', 'trust_badge_3_text',
                'trust_badge_4_icon', 'trust_badge_4_text',
                'footer_text', 'seo_title', 'seo_description', 'seo_keywords',
                'social_instagram', 'social_facebook', 'social_youtube', 'social_tiktok',
            ]);
        });
    }
};
