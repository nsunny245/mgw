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
        $city = City::where('slug', $slug)->firstOrFail();

        $seoData = \App\Helpers\SeoContentHelper::getForCity($slug);
        $seoTitle = $seoData['title'] ?? ($city->meta_title ?? $city->name);
        $seoDescription = $seoData['description'] ?? ($city->meta_description ?? 'Umrah packages from UK cities');
        $seoH1 = $seoData['h1'] ?? $city->name;
        $seoIntro = $seoData['intro'] ?? null;
        $seoFaqs = $seoData['faqs'] ?? null;

        SEOTools::setTitle($seoTitle);
        SEOTools::setDescription($seoDescription);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $packages = Package::where('departure_city', $city->name)->latest()->get();

        return view('frontend.cities.show', compact('city', 'packages', 'seoTitle', 'seoDescription', 'seoH1', 'seoIntro', 'seoFaqs'));
    }
}
