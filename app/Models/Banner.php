<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Banner extends Model
{
    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('headerBanners'));
        static::deleted(fn () => Cache::forget('headerBanners'));
    }

    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'url',
        'status',
        'sort',
        'service_id',
        'category_id',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
