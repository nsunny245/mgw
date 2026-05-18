@extends('frontend.layouts.app')

@section('title', 'Umrah Travel Blog')
@section('meta_description', 'Latest Umrah travel tips and guides')

@section('content')
<section class="section-padding">
    <div class="container">
        <h1 class="fw-bold mb-5">Umrah Travel Blog</h1>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-4 mb-4">
                    <div class="package-card">
                        <img src="{{ $blog->getFirstMediaUrl('blogs') ?: 'https://placehold.co/600x350?text=Blog' }}" class="img-fluid" alt="{{ $blog->title }}">
                        <div class="p-4">
                            <h5>{{ $blog->title }}</h5>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-gold mt-3">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $blogs->links() }}
    </div>
</section>
@endsection
