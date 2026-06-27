@extends('frontend.layouts.app')

@section('title', $category->name)
@section('meta_description', 'Browse ' . $category->name . ' for high quality Umrah packages.')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $category->name])

<section class="section-padding py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">{{ $category->name }}</h1>
        <p class="text-muted mb-5">Explore our range of premium packages for {{ $category->name }}. Choose the plan that best fits your travel and budget requirements.</p>
        
        <div class="row g-4">
            @forelse($packages as $package)
                @include('frontend.components.package-card')
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4 mb-3">No packages available in this category at the moment.</div>
                    <a href="{{ url('/') }}" class="btn btn-primary">Return Home</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
