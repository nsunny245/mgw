<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\City;
use App\Models\Package;
use App\Models\Testimonial;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Makkah Gateway - Best Umrah Packages from UK');
        SEOTools::setDescription('Affordable Umrah packages from UK with ATOL protection, luxury hotels, flights and visa support.');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $featuredPackages = Package::where('featured', 1)->latest()->take(6)->get();
        $cities = City::latest()->take(6)->get();
        $blogs = Blog::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->take(6)->get();

        return view('frontend.home.index', compact(
            'featuredPackages',
            'cities',
            'blogs',
            'testimonials'
        ));
    }
}
