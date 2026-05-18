@extends('frontend.layouts.app')

@section('title', 'Page Not Found')
@section('meta_description', 'Page not found')

@section('content')
<section class="section-padding text-center">
    <div class="container">
        <h1 class="display-4 fw-bold text-green">404</h1>
        <p class="lead">The page you are looking for does not exist.</p>
        <a href="/" class="btn btn-gold">Go Home</a>
    </div>
</section>
@endsection
