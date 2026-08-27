<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Package;
use Artesaos\SEOTools\Facades\SEOTools;

class CityController extends Controller
{
    public function show($slug)
    {
        $city = City::with('seo')->where('slug', $slug)->firstOrFail();

        $canonicalService = app(\App\Services\Seo\CanonicalUrlService::class);
        $canonicalService->setActiveModel($city);

        $seoData = \App\Helpers\SeoContentHelper::getForCity($slug);
        $seoTitle = ($city->seo && $city->seo->meta_title) ? $city->seo->meta_title : ($seoData['title'] ?? ($city->meta_title ?? $city->name));
        $seoDescription = ($city->seo && $city->seo->meta_description) ? $city->seo->meta_description : ($seoData['description'] ?? ($city->meta_description ?? 'Umrah packages from UK cities'));
        $seoH1 = $seoData['h1'] ?? $city->name;
        $seoIntro = $seoData['intro'] ?? null;
        $seoFaqs = $seoData['faqs'] ?? null;

        SEOTools::setTitle($seoTitle);
        SEOTools::setDescription($seoDescription);

        $canonicalUrl = $canonicalService->forCurrentRequest();
        SEOTools::setCanonical($canonicalUrl);
        SEOTools::opengraph()->setUrl($canonicalUrl);
        SEOTools::opengraph()->addProperty('type', 'website');

        $ogImage = ($city->seo && $city->seo->og_image) ? $city->seo->og_image : asset('frontend/images/hero-bg.png');
        SEOTools::opengraph()->addImage($ogImage);

        $packages = Package::whereHas('cities', function ($q) use ($city) {
            $q->where('cities.id', $city->id);
        })
        ->orWhere('departure_city', $city->name)
        ->orWhere('departure_city', 'like', '%' . trim($city->name) . '%')
        ->latest()
        ->get();

        return view('frontend.cities.show', compact('city', 'packages', 'seoTitle', 'seoDescription', 'seoH1', 'seoIntro', 'seoFaqs'));
    }
}
