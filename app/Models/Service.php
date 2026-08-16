<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'image',
        'short_description', 'description', 'requirement', 'information', 'benefit',
        'price', 'icon',
        'whatsapp', 'wa_message', 'status',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    public function serviceItems(): HasMany
    {
        return $this->hasMany(ServiceItem::class)->orderBy('sort');
    }
}
