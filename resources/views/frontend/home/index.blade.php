@extends('frontend.layouts.app')

@section('title', 'Makkah Gateway - Best Umrah Packages from UK')
@section('meta_description', 'Affordable Umrah packages from UK with ATOL protection, luxury hotels, flights and visa support.')

@section('content')
@include('frontend.partials.hero')
@include('frontend.home.carousel')
@include('frontend.home.packages')
@include('frontend.home.whychoose')
@include('frontend.home.testimonials')
@include('frontend.home.cities')
@include('frontend.home.cta')
@include('frontend.home.blogs')
@endsection
