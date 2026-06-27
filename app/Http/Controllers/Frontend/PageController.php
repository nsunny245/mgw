<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;

class PageController extends Controller
{
    public function show($slug = 'about-us')
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle($page->meta_title ?? $page->title);
        SEOTools::setDescription($page->meta_description ?? 'Makkah Gateway');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        return view('frontend.pages.about', compact('page'));
    }
}
