<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoRedirect extends Model
{
    protected $table = 'seo_redirects';

    protected $fillable = [
        'source_path',
        'destination_url',
        'status_code',
        'is_active',
        'hit_count',
        'last_hit_at',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_hit_at' => 'datetime',
        'hit_count' => 'integer',
        'status_code' => 'integer',
    ];
}
