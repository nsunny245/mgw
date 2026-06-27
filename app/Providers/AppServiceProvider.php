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

        // Share settings globally with all views safely, fall back to new model to prevent Undefined Variable exceptions
        try {
            $settings = null;
            if (app()->hasDatabaseConnection() && \Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::first();
            }
            view()->share('settings', $settings ?? new \App\Models\Setting());
        } catch (\Exception $e) {
            view()->share('settings', new \App\Models\Setting());
        }

        view()->composer('frontend.partials.header', function ($view) {
            $monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            // Map static month names to objects for easy navigation routing
            $monthlyCategories = collect($monthNames)->map(fn ($month) => (object) [
                'name' => $month,
                'slug' => strtolower($month),
            ]);

            // Query core categories for the dropdown menu
            $specialCategories = \App\Models\Category::all();

            $cities = \App\Models\City::all();

            $view->with(compact('monthlyCategories', 'specialCategories', 'cities'));
        });
    }
}
