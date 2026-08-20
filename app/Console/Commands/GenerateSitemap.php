<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\City;
use App\Models\Package;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'generate:sitemap';
    protected $description = 'Generate Sitemap';

    public function handle()
    {
        $sitemap = Sitemap::create();
        $base = config('app.url');
        if (empty($base) || in_array($base, ['http://localhost', 'http://127.0.0.1', 'http://127.0.0.1:8080', 'http://127.0.0.1:8000'])) {
            $base = 'https://makkahgateway.co.uk';
        }
        $base = rtrim($base, '/');

        $sitemap->add(Url::create("{$base}/"));
        Package::all()->each(fn ($p) => $sitemap->add(Url::create("{$base}/package/{$p->slug}")));
        Blog::all()->each(fn ($b) => $sitemap->add(Url::create("{$base}/blog/{$b->slug}")));
        City::all()->each(fn ($c) => $sitemap->add(Url::create("{$base}/umrah-packages-{$c->slug}")));

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap Generated');
    }
}
