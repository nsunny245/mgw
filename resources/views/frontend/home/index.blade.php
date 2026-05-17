@extends('frontend.layouts.app')

@section('title', 'Makkah Gateway')

@section('content')
@include('frontend.home.hero')
@include('frontend.home.trustbar')
@include('frontend.home.packages')
@include('frontend.home.whychoose')
@include('frontend.home.testimonials')
@include('frontend.home.cities')
@include('frontend.home.blogs')
@endsection
