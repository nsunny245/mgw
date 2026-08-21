<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Artesaos\SEOTools\Facades\SEOTools;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::with('seo')->where('slug', $slug)->firstOrFail();

        $canonicalService = app(\App\Services\Seo\CanonicalUrlService::class);
        $canonicalService->setActiveModel($category);

        $seoData = \App\Helpers\SeoContentHelper::getForCategory($slug);
        $seoTitle = ($category->seo && $category->seo->meta_title) ? $category->seo->meta_title : ($seoData['title'] ?? ($category->meta_title ?? $category->name));
        $seoDescription = ($category->seo && $category->seo->meta_description) ? $category->seo->meta_description : ($seoData['description'] ?? ($category->meta_description ?? 'Browse ' . $category->name . ' for high quality Umrah packages.'));
        $seoH1 = $seoData['h1'] ?? $category->name;
        $seoIntro = $seoData['intro'] ?? null;
        $seoFaqs = $seoData['faqs'] ?? null;

        SEOTools::setTitle($seoTitle);
        SEOTools::setDescription($seoDescription);

        $canonicalUrl = $canonicalService->forCurrentRequest();
        SEOTools::setCanonical($canonicalUrl);
        SEOTools::opengraph()->setUrl($canonicalUrl);
        SEOTools::opengraph()->addProperty('type', 'website');

        $ogImage = ($category->seo && $category->seo->og_image) ? $category->seo->og_image : asset('frontend/images/hero-bg.png');
        SEOTools::opengraph()->addImage($ogImage);

        SEOTools::twitter()->setSite('@makkahgateway');

        $packages = Package::where('category_id', $category->id)->latest()->get();

        return view('frontend.categories.show', compact('category', 'packages', 'seoTitle', 'seoDescription', 'seoH1', 'seoIntro', 'seoFaqs'));
    }
}
