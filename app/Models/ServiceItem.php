<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceItem extends Model
{
    protected $fillable = [
        'service_id', 'slug', 'title', 'tagline', 'image', 'description', 'info', 'sort', 'status',
        'whatsapp', 'wa_message',
        'star', 'distance',
        'price_per_night', 'price_max',
        'map_link', 'benefit', 'gallery',
        'area', 'walk_time', 'room_types', 'recommendation',
        'pax_prices',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'star' => 'integer',
            'price_per_night' => 'decimal:2',
            'price_max' => 'decimal:2',
            'gallery' => 'array',
            'pax_prices' => 'array',
        ];
    }

    public function paxPrices(): array
    {
        return is_array($this->pax_prices) ? $this->pax_prices : [];
    }

    protected static function booted(): void
    {
        static::creating(function (self $item) {
            if (empty($item->slug)) {
                $item->slug = app(\App\Services\SlugService::class)->make((string) ($item->title ?? ''), 'service_items');
            }
        });
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function isHotel(): bool
    {
        return $this->star !== null
            || $this->distance !== null
            || $this->meals !== null
            || $this->room_type !== null
            || $this->price_per_night !== null
            || $this->price_max !== null
            || ($this->service?->category && $this->service->category->itemLabel() === 'Hotel');
    }

    public function distanceLabel(): ?string
    {
        $value = trim((string) $this->distance);

        if ($value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return '± ' . number_format(round((float) $value), 0, ',', '.') . ' meter';
        }

        return $value;
    }

    public function starSymbols(): string
    {
        if ($this->star === null) {
            return '';
        }

        $filled = str_repeat('★', max(0, min(5, $this->star)));
        $outline = str_repeat('☆', 5 - max(0, min(5, $this->star)));

        return $filled . $outline;
    }

    public function priceLabel(): ?string
    {
        if ($this->price_per_night === null) {
            return null;
        }

        $min = number_format((float) $this->price_per_night, 0, ',', '.');

        if ($this->price_max !== null) {
            $max = number_format((float) $this->price_max, 0, ',', '.');

            return 'SAR ' . $min . ' - ' . $max;
        }

        return 'SAR ' . $min;
    }

    public function priceLabelUSD(): ?string
    {
        if ($this->price_per_night === null) {
            return null;
        }

        $min = number_format((float) $this->price_per_night, 2, ',', '.');

        if ($this->price_max !== null) {
            $max = number_format((float) $this->price_max, 2, ',', '.');

            return 'US$' . $min . ' - US$' . $max;
        }

        return 'US$' . $min;
    }

    public function mapUrl(): ?string
    {
        if (! empty($this->map_link)) {
            return $this->map_link;
        }

        $service = $this->service;

        // Kota Jeddah untuk sementara dihapus — fokus Mekkah & Madinah.
        if ($service && $service->hotelCity() === 'Jeddah') {
            return null;
        }

        if ($service && $service->isMadinah()) {
            $city = 'Madinah';
            $destination = 'Masjid Nabawi, Madinah';
        } else {
            $city = $service?->hotelCity() ?: ($service?->title ?: 'Makkah');
            $destination = 'Masjid al-Haram, Makkah';
        }

        return 'https://www.google.com/maps/dir/?api=1&origin=' . urlencode($this->title . ', ' . $city . ', Saudi Arabia')
            . '&destination=' . urlencode($destination)
            . '&travelmode=walking';
    }

    public function galleryImages(): array
    {
        $images = [];

        if ($this->image && ! str_ends_with($this->image, '.svg')) {
            $images[] = $this->image;
        }

        if (is_array($this->gallery)) {
            foreach ($this->gallery as $path) {
                if (is_string($path) && ! str_ends_with($path, '.svg')) {
                    $images[] = $path;
                }
            }
        }

        return array_values(array_unique($images));
    }

    public function benefitList(): array
    {
        if (empty($this->benefit)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->benefit))));
    }
}
