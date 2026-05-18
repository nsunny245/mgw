@extends('frontend.layouts.app')

@section('title', $city->meta_title ?? $city->name)
@section('meta_description', $city->meta_description ?? 'Umrah packages by city')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $city->name])

<section class="section-padding">
    <div class="container">
        <h1 class="fw-bold mb-4">Umrah Packages From {{ $city->name }}</h1>
        <div class="mb-5">{!! $city->content !!}</div>
        <div class="row">
            @foreach($packages as $package)
                @include('frontend.components.package-card')
            @endforeach
        </div>
    </div>
</section>
@endsection
