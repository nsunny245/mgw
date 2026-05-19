<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Umrah Travel Blog');
        SEOTools::setDescription('Latest Umrah travel guides, tips, and updates.');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $blogs = Blog::latest()->paginate(9);

        return view('frontend.blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle($blog->meta_title ?? $blog->title);
        SEOTools::setDescription($blog->meta_description ?? 'Latest Umrah blog updates');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage($blog->getFirstMediaUrl('blogs') ?: asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $relatedBlogs = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();

        return view('frontend.blog.show', compact('blog', 'relatedBlogs'));
    }
}
