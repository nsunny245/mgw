<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\City;
use App\Models\Package;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
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
