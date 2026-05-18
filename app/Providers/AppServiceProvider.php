<?php

namespace App\Providers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        SEOMeta::setTitleDefault('Makkah Gateway');
        OpenGraph::setSiteName('Makkah Gateway');
    }
}
