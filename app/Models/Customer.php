<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'status',
        'sumber',
        'layanan',
        'item',
        'counts',
    ];

    public const STATUSES = [
        'baru' => 'Baru',
        'pelanggan' => 'Pelanggan',
        'dihubungi' => 'Dihubungi',
        'konversi' => 'Konversi',
        'batal' => 'Batal',
    ];

    public const STATUS_COLORS = [
        'baru' => 'text-white bg-amber-500 border-amber-500',
        'pelanggan' => 'text-white bg-emerald-500 border-emerald-500',
        'dihubungi' => 'text-white bg-sky-500 border-sky-500',
        'konversi' => 'text-white bg-emerald-600 border-emerald-600',
        'batal' => 'text-white bg-red-500 border-red-500',
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(CustomerStatusHistory::class)->oldest('id');
    }
}