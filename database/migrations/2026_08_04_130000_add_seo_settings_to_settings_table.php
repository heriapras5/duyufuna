<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const COLUMNS = [
        'og_title',
        'og_description',
        'og_type',
        'og_site_name',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical_url',
        'robots',
        'google_site_verification',
        'bing_site_verification',
        'google_analytics_id',
        'google_tag_manager_id',
        'schema_enabled',
        'org_name',
        'org_logo',
        'org_phone',
        'org_email',
        'org_address',
        'org_geo_lat',
        'org_geo_lng',
        'sitemap_enabled',
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
            $table->string('og_title')->nullable()->after('og_image');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_type')->nullable()->after('og_description');
            $table->string('og_site_name')->nullable()->after('og_type');
            $table->string('twitter_card')->nullable()->after('og_site_name');
            $table->string('twitter_title')->nullable()->after('twitter_card');
            $table->text('twitter_description')->nullable()->after('twitter_title');
            $table->text('twitter_image')->nullable()->after('twitter_description');
            $table->string('canonical_url')->nullable()->after('twitter_image');
            $table->string('robots')->nullable()->after('canonical_url');
            $table->string('google_site_verification')->nullable()->after('robots');
            $table->string('bing_site_verification')->nullable()->after('google_site_verification');
            $table->string('google_analytics_id')->nullable()->after('bing_site_verification');
            $table->string('google_tag_manager_id')->nullable()->after('google_analytics_id');
            $table->boolean('schema_enabled')->default(false)->after('google_tag_manager_id');
            $table->string('org_name')->nullable()->after('schema_enabled');
            $table->text('org_logo')->nullable()->after('org_name');
            $table->string('org_phone')->nullable()->after('org_logo');
            $table->string('org_email')->nullable()->after('org_phone');
            $table->text('org_address')->nullable()->after('org_email');
            $table->string('org_geo_lat')->nullable()->after('org_address');
            $table->string('org_geo_lng')->nullable()->after('org_geo_lat');
            $table->boolean('sitemap_enabled')->default(true)->after('org_geo_lng');
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
