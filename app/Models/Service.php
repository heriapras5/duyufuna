<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'image', 'gallery',
        'short_description', 'description', 'requirement', 'information', 'benefit',
        'price', 'price_sar', 'icon', 'duration',
        'whatsapp', 'wa_message', 'status',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'price' => 'decimal:2',
            'price_sar' => 'decimal:2',
            'gallery' => 'array',
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

    public static function capacityMap(): array
    {
        return [
            'Camry'    => ['pax' => 4,  'bag' => 4],
            'Ford'     => ['pax' => 6,  'bag' => 6],
            'Lexus'    => ['pax' => 4,  'bag' => 4],
            'Traverse' => ['pax' => 7,  'bag' => 7],
            'GMC'      => ['pax' => 7,  'bag' => 7],
            'Staria'   => ['pax' => 7,  'bag' => 10],
            'Hiace'    => ['pax' => 11, 'bag' => 11],
            'Coaster'  => ['pax' => 25, 'bag' => 30],
            'Bus'      => ['pax' => 49, 'bag' => 95],
        ];
    }

    public function capacity(): ?array
    {
        return static::capacityMap()[$this->title] ?? null;
    }

    public function capacityLabel(): ?string
    {
        $cap = $this->capacity();
        if (!$cap) {
            return null;
        }

        return $cap['pax'] . ' Pax - ' . $cap['bag'] . ' Bag';
    }

    public function isMakkah(): bool
    {
        return str_contains(strtolower($this->slug), 'mekkah')
            || str_contains(strtolower($this->slug), 'makkah')
            || str_contains(strtolower($this->title), 'mekkah')
            || str_contains(strtolower($this->title), 'makkah');
    }

    public function isMadinah(): bool
    {
        return str_contains(strtolower($this->slug), 'madinah')
            || str_contains(strtolower($this->title), 'madinah');
    }

    public function hotelCity(): ?string
    {
        if ($this->isMakkah()) {
            return 'Mekkah';
        }

        if ($this->isMadinah()) {
            return 'Madinah';
        }

        if (str_contains(strtolower($this->slug), 'jeddah') || str_contains(strtolower($this->title), 'jeddah')) {
            return 'Jeddah';
        }

        return null;
    }

    public function distanceLabel(): string
    {
        return match (true) {
            $this->isMakkah() => 'Jarak dari Masjidil Haram',
            $this->isMadinah() => 'Jarak dari Masjid Nabawi',
            default => 'Jarak',
        };
    }

    public function galleryImages(): array
    {
        $images = [];

        if ($this->image && !str_ends_with($this->image, '.svg')) {
            $images[] = $this->image;
        }

        if (is_array($this->gallery)) {
            foreach ($this->gallery as $path) {
                if (is_string($path) && !str_ends_with($path, '.svg')) {
                    $images[] = $path;
                }
            }
        }

        return array_values(array_unique($images));
    }
}
