<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = 'traffics';

    protected $fillable = [
        'route_name', 'menu', 'url', 'referrer', 'ip',
        'user_agent', 'device', 'is_lead',
        'nama', 'no_hp', 'category', 'service', 'item', 'status',
    ];

    protected function casts(): array
    {
        return [
            'is_lead' => 'boolean',
        ];
    }

    public function scopeLeads($query)
    {
        return $query->where('is_lead', true);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'no_hp', 'no_hp');
    }
}
