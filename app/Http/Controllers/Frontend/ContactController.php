<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;

class ContactController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'contact-us')->first();

        if ($page) {
            SEOTools::setTitle($page->meta_title ?? $page->title);
            SEOTools::setDescription($page->meta_description ?? 'Contact Us');
        } else {
            SEOTools::setTitle('Contact Us');
        }

        return view('frontend.contact.index', compact('page'));
    }
}
