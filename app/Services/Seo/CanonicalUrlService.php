<?php

namespace App\Services\Seo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class CanonicalUrlService
{
    /**
     * The active model for the current request.
     */
    protected ?Model $activeModel = null;

    /**
     * Set the active model for the request.
     */
    public function setActiveModel(Model $model): void
    {
        $this->activeModel = $model;

        // Apply metadata automatically when active model is set
        if ($model->relationLoaded('seo') && $model->seo) {
            $seo = $model->seo;
            if ($seo->meta_title) {
                SEOTools::setTitle($seo->meta_title);
            }
            if ($seo->meta_description) {
                SEOTools::setDescription($seo->meta_description);
            }
            
            $robots = ($seo->robots_index ? 'index' : 'noindex') . ',' . ($seo->robots_follow ? 'follow' : 'nofollow');
            SEOTools::metatags()->addMeta('robots', $robots);
        }
    }

    /**
     * Get the canonical URL for the current request.
     */
    public function forCurrentRequest(): string
    {
        // 1. If an active model is set, check for canonical override
        if ($this->activeModel && $this->activeModel->relationLoaded('seo') && $this->activeModel->seo) {
            if (!empty($this->activeModel->seo->canonical_url_override)) {
                return $this->activeModel->seo->canonical_url_override;
            }
            return $this->forModel($this->activeModel);
        }

        $path = Request::getPathInfo();
        $base = $this->getPreferredBaseUrl();
        
        $canonical = rtrim($base . $path, '/');
        
        // Retain only valid page parameter if present (avoid parameter duplicates)
        if (Request::has('page') && is_numeric(Request::input('page'))) {
            $canonical .= '?page=' . Request::input('page');
        }

        return $canonical ?: $base;
    }

    /**
     * Get the canonical URL for a specific model.
     */
    public function forModel(Model $model): string
    {
        $base = $this->getPreferredBaseUrl();

        if (method_exists($model, 'getTable')) {
            switch ($model->getTable()) {
                case 'packages':
                    return "{$base}/package/{$model->slug}";
                case 'categories':
                    return "{$base}/category/{$model->slug}";
                case 'blogs':
                    return "{$base}/blog/{$model->slug}";
                case 'cities':
                    return "{$base}/umrah-packages-{$model->slug}";
            }
        }

        return $base;
    }

    /**
     * Get the configured preferred base URL domain.
     */
    public function getPreferredBaseUrl(): string
    {
        $url = config('app.url') ?: 'https://www.makkahgateway.co.uk';
        
        // Normalise local development domains to live fallback domain
        if (empty($url) || in_array($url, ['http://localhost', 'http://127.0.0.1', 'http://127.0.0.1:8080', 'http://127.0.0.1:8000'])) {
            $url = 'https://www.makkahgateway.co.uk';
        }

        return rtrim($url, '/');
    }
}
