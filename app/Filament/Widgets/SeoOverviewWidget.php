<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\City;
use App\Models\Package;
use App\Models\SeoMeta;
use App\Models\SeoRedirect;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SeoOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $seoMetasCount = SeoMeta::count();
        $activeRedirects = SeoRedirect::where('is_active', true)->count();
        $totalRedirectHits = SeoRedirect::sum('hit_count');
        
        $packagesCount = Package::count();
        $blogsCount = Blog::count();
        $citiesCount = City::count();
        $sitemapUrlsCount = 6 + $packagesCount + $blogsCount + $citiesCount;

        return [
            Stat::make('SEO Configured Pages', $seoMetasCount)
                ->description('Polymorphic metadata entries in database')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            Stat::make('Active 301 Redirects', $activeRedirects)
                ->description("Processed {$totalRedirectHits} legacy URL hits")
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
            Stat::make('Sitemap URLs Indexed', $sitemapUrlsCount)
                ->description("Spread across 5 child sitemaps")
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('info'),
        ];
    }
}
