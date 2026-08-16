<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'image',
        'review',
        'rating',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'rating' => 'integer',
        ];
    }
}
