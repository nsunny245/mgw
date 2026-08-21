<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Artesaos\SEOTools\Facades\SEOTools;

class PackageController extends Controller
{
    public function show($slug)
    {
        $package = Package::with('seo')->where('slug', $slug)->firstOrFail();

        $canonicalService = app(\App\Services\Seo\CanonicalUrlService::class);
        $canonicalService->setActiveModel($package);

        if (!$package->seo || !$package->seo->meta_title) {
            SEOTools::setTitle($package->meta_title ?? $package->title);
        }
        if (!$package->seo || !$package->seo->meta_description) {
            SEOTools::setDescription($package->meta_description ?? 'Best Umrah Packages');
        }

        $canonicalUrl = $canonicalService->forCurrentRequest();
        SEOTools::setCanonical($canonicalUrl);
        SEOTools::opengraph()->setUrl($canonicalUrl);
        SEOTools::opengraph()->addProperty('type', 'website');
        
        $ogImage = ($package->seo && $package->seo->og_image) ? $package->seo->og_image : ($package->getFirstMediaUrl('packages') ?: asset('frontend/images/hero-bg.png'));
        SEOTools::opengraph()->addImage($ogImage);

        SEOTools::twitter()->setSite('@makkahgateway');

        $relatedPackages = Package::where('id', '!=', $package->id)->latest()->take(3)->get();

        return view('frontend.packages.show', compact('package', 'relatedPackages'));
    }
}
