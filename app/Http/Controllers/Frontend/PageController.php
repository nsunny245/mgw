<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;

class PageController extends Controller
{
    public function show($slug = 'about-us')
    {
        $page = Page::with('seo')->where('slug', $slug)->firstOrFail();

        $canonicalService = app(\App\Services\Seo\CanonicalUrlService::class);
        $canonicalService->setActiveModel($page);

        if (!$page->seo || !$page->seo->meta_title) {
            SEOTools::setTitle($page->meta_title ?? $page->title);
        }
        if (!$page->seo || !$page->seo->meta_description) {
            SEOTools::setDescription($page->meta_description ?? 'Makkah Gateway');
        }

        $canonicalUrl = $canonicalService->forCurrentRequest();
        SEOTools::setCanonical($canonicalUrl);
        SEOTools::opengraph()->setUrl($canonicalUrl);
        SEOTools::opengraph()->addProperty('type', 'website');

        $ogImage = ($page->seo && $page->seo->og_image) ? $page->seo->og_image : asset('frontend/images/hero-bg.png');
        SEOTools::opengraph()->addImage($ogImage);

        SEOTools::twitter()->setSite('@makkahgateway');

        return view('frontend.pages.about', compact('page'));
    }
}
