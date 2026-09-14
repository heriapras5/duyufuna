<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'subtitle',
        'sort',
        'is_catalog',
        'page_type',
        'group_label',
        'item_label',
        'description',
        'whatsapp',
        'wa_message',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'is_catalog' => 'boolean',
        ];
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    public function scopeCatalog(Builder $query): Builder
    {
        return $query->where('page_type', 'catalog');
    }

    public function isCatalog(): bool
    {
        return $this->pageType() === 'catalog';
    }

    public function isHotel(): bool
    {
        return $this->slug === 'hotel' || $this->itemLabel() === 'Hotel';
    }

    public function isHandling(): bool
    {
        return $this->slug === 'handling';
    }

    public function pageType(): string
    {
        return $this->page_type ?: 'cards';
    }

    public function groupLabel(): string
    {
        return $this->group_label ?: 'Grup';
    }

    public function itemLabel(): string
    {
        return $this->item_label ?: 'Item';
    }

    public function groupPlaceholder(): string
    {
        return static::placeholderFor($this->groupLabel());
    }

    public function itemPlaceholder(): string
    {
        return static::placeholderFor($this->itemLabel());
    }

    public static function placeholderFor(string $label): string
    {
        return match (mb_strtolower(trim($label))) {
            'kota' => 'Contoh: Makkah, Madinah',
            'hotel' => 'Contoh: Mercure Hotel',
            'jenis' => 'Contoh: Visa Umroh, Visa Bisnis',
            'paket' => 'Contoh: Paket Hemat 12 Hari',
            'produk' => 'Contoh: Kurma Sukari',
            'pilihan' => 'Contoh: Paket Umroh 12 Hari',
            default => 'Contoh: Nama ' . $label,
        };
    }
}
