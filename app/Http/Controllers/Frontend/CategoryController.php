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
        $category = Category::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle($category->name);
        SEOTools::setDescription('Browse ' . $category->name . ' for high quality Umrah packages.');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $packages = Package::where('category_id', $category->id)->latest()->get();

        return view('frontend.categories.show', compact('category', 'packages'));
    }
}
