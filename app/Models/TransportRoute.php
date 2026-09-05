<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransportRoute extends Model
{
    protected $fillable = [
        'code', 'name_ar', 'pickup_label', 'dropoff_label', 'sort',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(TransportPrice::class, 'route_id');
    }
}