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
        'include_flights',
        'include_hotels',
        'include_transport',
        'available_all_year',
        'month',
        'status',
        'category_id',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'month' => 'array',
        'featured' => 'boolean',
        'include_flights' => 'boolean',
        'include_hotels' => 'boolean',
        'include_transport' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($package) {
            $months = $package->month;
            if (is_array($months)) {
                if (in_array('All Year Round', $months) || empty($months)) {
                    $package->available_all_year = true;
                } else {
                    $package->available_all_year = false;
                }
            } else {
                if ($months === 'All Year Round' || empty($months)) {
                    $package->available_all_year = true;
                } else {
                    $package->available_all_year = false;
                }
            }
        });
    }

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
