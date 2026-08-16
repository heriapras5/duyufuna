<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('article_category_id')->nullable()->after('id')
                ->constrained()->nullOnDelete();
            $table->string('seo_title')->nullable()->after('published_at');
            $table->string('seo_description')->nullable()->after('seo_title');
            $table->string('seo_keywords')->nullable()->after('seo_description');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('article_category_id');
            $table->dropColumn(['seo_title', 'seo_description', 'seo_keywords']);
        });
    }
};
