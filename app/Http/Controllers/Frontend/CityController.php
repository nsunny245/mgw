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
        SEOTools::setTitle($city->meta_title ?? $city->name);
        SEOTools::setDescription($city->meta_description ?? 'Umrah packages from UK cities');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $packages = Package::latest()->take(6)->get();

        return view('frontend.cities.show', compact('city', 'packages'));
    }
}
