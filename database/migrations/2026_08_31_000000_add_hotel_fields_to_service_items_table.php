<?php

use App\Services\SlugService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('id');
            $table->tinyInteger('star')->nullable()->after('status');
            $table->decimal('distance', 8, 1)->nullable()->after('star');
            $table->string('meals')->nullable()->after('distance');
            $table->string('room_type')->nullable()->after('meals');
            $table->decimal('price_per_night', 15, 2)->nullable()->after('room_type');
            $table->decimal('price_max', 15, 2)->nullable()->after('price_per_night');
            $table->date('check_in')->nullable()->after('price_max');
            $table->date('check_out')->nullable()->after('check_in');
            $table->string('map_link')->nullable()->after('check_out');
            $table->text('benefit')->nullable()->after('map_link');
            $table->json('gallery')->nullable()->after('benefit');
        });

        DB::table('service_items')->orderBy('id')->each(function ($row) {
            if (empty($row->slug)) {
                $slug = app(SlugService::class)->make($row->title, 'service_items', $row->id);
                DB::table('service_items')->where('id', $row->id)->update(['slug' => $slug]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'star', 'distance', 'meals', 'room_type',
                'price_per_night', 'price_max', 'check_in', 'check_out',
                'map_link', 'benefit', 'gallery',
            ]);
        });
    }
};