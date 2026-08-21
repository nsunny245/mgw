<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'meta_title',
        'meta_description',
        'canonical_url_override',
        'robots_index',
        'robots_follow',
        'og_title',
        'og_description',
        'og_image',
        'primary_keyword',
        'secondary_keywords',
        'schema_overrides',
    ];

    protected $casts = [
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
        'secondary_keywords' => 'array',
        'schema_overrides' => 'array',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
