<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = [
        'name',
        'location',
        'slides',
        'active',
    ];

    protected $casts = [
        'slides' => 'array',
        'active' => 'boolean',
    ];
}
