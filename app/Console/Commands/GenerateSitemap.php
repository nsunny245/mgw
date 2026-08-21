<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\City;
use App\Models\Package;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'generate:sitemap';
    protected $description = 'Generate Split Sitemap Index and Child Files';

    public function handle()
    {
        $base = config('app.url');
        if (empty($base) || in_array($base, ['http://localhost', 'http://127.0.0.1', 'http://127.0.0.1:8080', 'http://127.0.0.1:8000'])) {
            $base = 'https://www.makkahgateway.co.uk';
        }
        $base = rtrim($base, '/');

        // 1. Generate sitemap-pages.xml
        $pagesSitemap = Sitemap::create();
        
        $pagesSitemap->add(Url::create("{$base}/")
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));
            
        $pagesSitemap->add(Url::create("{$base}/about-us")
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.8));
            
        $pagesSitemap->add(Url::create("{$base}/contact")
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.8));
            
        $pagesSitemap->add(Url::create("{$base}/faq")
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8));
            
        $pagesSitemap->add(Url::create("{$base}/terms-and-conditions")
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.5));
            
        $pagesSitemap->add(Url::create("{$base}/disclaimer")
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.5));

        Page::all()->each(function ($p) use ($pagesSitemap, $base) {
            $pagesSitemap->add(Url::create("{$base}/{$p->slug}")
                ->setLastModificationDate($p->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7));
        });
        $pagesSitemap->writeToFile(public_path('sitemap-pages.xml'));

        // 2. Generate sitemap-packages.xml
        $packagesSitemap = Sitemap::create();
        Package::all()->each(function ($p) use ($packagesSitemap, $base) {
            $packagesSitemap->add(Url::create("{$base}/package/{$p->slug}")
                ->setLastModificationDate($p->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        });
        $packagesSitemap->writeToFile(public_path('sitemap-packages.xml'));

        // 3. Generate sitemap-categories.xml
        $categoriesSitemap = Sitemap::create();
        Category::all()->each(function ($cat) use ($categoriesSitemap, $base) {
            $categoriesSitemap->add(Url::create("{$base}/category/{$cat->slug}")
                ->setLastModificationDate($cat->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        });
        $categoriesSitemap->writeToFile(public_path('sitemap-categories.xml'));

        // 4. Generate sitemap-cities.xml
        $citiesSitemap = Sitemap::create();
        City::all()->each(function ($c) use ($citiesSitemap, $base) {
            $citiesSitemap->add(Url::create("{$base}/umrah-packages-{$c->slug}")
                ->setLastModificationDate($c->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        });
        $citiesSitemap->writeToFile(public_path('sitemap-cities.xml'));

        // 5. Generate sitemap-blog.xml
        $blogSitemap = Sitemap::create();
        Blog::all()->each(function ($b) use ($blogSitemap, $base) {
            $blogSitemap->add(Url::create("{$base}/blog/{$b->slug}")
                ->setLastModificationDate($b->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        });
        $blogSitemap->writeToFile(public_path('sitemap-blog.xml'));

        // 6. Generate Sitemap Index (sitemap.xml)
        $sitemapIndex = SitemapIndex::create()
            ->add("{$base}/sitemap-pages.xml")
            ->add("{$base}/sitemap-packages.xml")
            ->add("{$base}/sitemap-categories.xml")
            ->add("{$base}/sitemap-cities.xml")
            ->add("{$base}/sitemap-blog.xml");
        
        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

        $this->info('Split Sitemaps Generated');
    }
}
