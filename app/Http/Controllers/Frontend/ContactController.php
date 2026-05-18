<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class ContactController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Contact Us');
        SEOTools::setDescription('Contact Makkah Gateway for Umrah package inquiries.');

        return view('frontend.contact.index');
    }
}
