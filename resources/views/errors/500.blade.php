@extends('frontend.layouts.app')

@section('title', 'Server Error')
@section('meta_description', 'Something went wrong')

@section('content')
<section class="section-padding text-center">
    <div class="container">
        <h1 class="display-5 fw-bold text-green">500</h1>
        <p class="lead">Something went wrong on our side. Please try again shortly.</p>
        <a href="/" class="btn btn-gold">Go Home</a>
    </div>
</section>
@endsection
