<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Models\Category;
use App\Models\City;
use App\Models\Blog;
use App\Models\Page;
use Illuminate\Console\Command;

class SeoAuditCommand extends Command
{
    protected $signature = 'seo:audit';
    protected $description = 'Perform technical SEO audit on all database-backed pages and templates';

    public function handle()
    {
        $this->info('Starting Makkah Gateway Technical SEO Audit...');
        $this->newLine();

        $rows = [];

        // 1. Audit Packages
        $this->info('Auditing Packages...');
        Package::with('seo')->chunk(50, function ($packages) use (&$rows) {
            foreach ($packages as $p) {
                $rows[] = $this->auditRecord($p, 'Package', "/package/{$p->slug}");
            }
        });

        // 2. Audit Categories
        $this->info('Auditing Categories...');
        Category::with('seo')->chunk(50, function ($categories) use (&$rows) {
            foreach ($categories as $cat) {
                $rows[] = $this->auditRecord($cat, 'Category', "/category/{$cat->slug}");
            }
        });

        // 3. Audit Cities
        $this->info('Auditing Cities...');
        City::with('seo')->chunk(50, function ($cities) use (&$rows) {
            foreach ($cities as $c) {
                $rows[] = $this->auditRecord($c, 'City', "/umrah-packages-{$c->slug}");
            }
        });

        // 4. Audit Blogs
        $this->info('Auditing Blogs...');
        Blog::with('seo')->chunk(50, function ($blogs) use (&$rows) {
            foreach ($blogs as $b) {
                $rows[] = $this->auditRecord($b, 'Blog', "/blog/{$b->slug}");
            }
        });

        // 5. Audit Pages
        $this->info('Auditing Pages...');
        Page::with('seo')->chunk(50, function ($pages) use (&$rows) {
            foreach ($pages as $page) {
                $rows[] = $this->auditRecord($page, 'Page', "/{$page->slug}");
            }
        });

        $this->newLine();
        $this->info('Technical SEO Audit Results:');
        
        $this->table(
            ['Type', 'URL Path', 'Title Status', 'Desc Status', 'Robots', 'Canonical Status', 'Score'],
            $rows
        );
    }

    /**
     * Audit an Eloquent model with SEO meta configuration.
     */
    protected function auditRecord($model, string $type, string $path): array
    {
        $seo = $model->seo;

        $title = $seo->meta_title ?? $model->meta_title ?? $model->title ?? $model->name ?? '';
        $desc = $seo->meta_description ?? $model->meta_description ?? '';
        
        $titleLen = strlen($title);
        $descLen = strlen($desc);

        // Score Calculation
        $score = 100;
        
        // Title validation
        if (empty($title)) {
            $titleStatus = '🔴 Missing';
            $score -= 30;
        } elseif ($titleLen < 30) {
            $titleStatus = '🟡 Too Short (' . $titleLen . ')';
            $score -= 10;
        } elseif ($titleLen > 65) {
            $titleStatus = '🟡 Too Long (' . $titleLen . ')';
            $score -= 10;
        } else {
            $titleStatus = '🟢 Good (' . $titleLen . ')';
        }

        // Description validation
        if (empty($desc)) {
            $descStatus = '🔴 Missing';
            $score -= 30;
        } elseif ($descLen < 100) {
            $descStatus = '🟡 Too Short (' . $descLen . ')';
            $score -= 10;
        } elseif ($descLen > 160) {
            $descStatus = '🟡 Too Long (' . $descLen . ')';
            $score -= 10;
        } else {
            $descStatus = '🟢 Good (' . $descLen . ')';
        }

        // Canonical checks
        if ($seo && !empty($seo->canonical_url_override)) {
            $canonicalStatus = '🔵 Overridden';
        } else {
            $canonicalStatus = '🟢 Standard';
        }

        // Index/Follow status
        $robots = '🟢 index,follow';
        if ($seo) {
            $robots = ($seo->robots_index ? 'index' : 'noindex') . ',' . ($seo->robots_follow ? 'follow' : 'nofollow');
            if (!$seo->robots_index) {
                $robots = '🔴 ' . $robots;
            }
        }

        return [
            $type,
            $path,
            $titleStatus,
            $descStatus,
            $robots,
            $canonicalStatus,
            $score . '/100',
        ];
    }
}
