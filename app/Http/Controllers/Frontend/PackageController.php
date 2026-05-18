<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Artesaos\SEOTools\Facades\SEOTools;

class PackageController extends Controller
{
    public function show($slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle($package->meta_title ?? $package->title);
        SEOTools::setDescription($package->meta_description ?? 'Best Umrah Packages');

        $relatedPackages = Package::where('id', '!=', $package->id)->latest()->take(3)->get();

        return view('frontend.packages.show', compact('package', 'relatedPackages'));
    }
}
