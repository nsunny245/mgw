<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Package extends Model implements HasMedia
{
    use Sluggable;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'price',
        'duration',
        'star_rating',
        'makkah_hotel',
        'madinah_hotel',
        'departure_city',
        'featured',
        'available_all_year',
        'status',
        'category_id',
        'meta_title',
        'meta_description',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function calendars()
    {
        return $this->hasMany(UmrahCalendar::class);
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
    }
}
