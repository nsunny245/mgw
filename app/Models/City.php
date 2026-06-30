<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'content',
        'meta_title',
        'meta_description',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
