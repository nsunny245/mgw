<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

        return view('frontend.home');
    }
}
