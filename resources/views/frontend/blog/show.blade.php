@extends('frontend.layouts.app')

@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? 'Umrah blog')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $blog->title])

<section class="section-padding">
    <div class="container">
        <img src="{{ $blog->getFirstMediaUrl('blogs') ?: 'https://placehold.co/900x500?text=Blog' }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
        <h1 class="fw-bold mb-4">{{ $blog->title }}</h1>
        {!! $blog->content !!}

        @if(isset($relatedBlogs) && $relatedBlogs->count())
            <hr class="my-5">
            <h3 class="fw-bold mb-4">Related Blogs</h3>
            <div class="row">
                @foreach($relatedBlogs as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="package-card">
                            <img src="{{ $item->getFirstMediaUrl('blogs') ?: 'https://placehold.co/600x350?text=Blog' }}" class="img-fluid" alt="{{ $item->title }}">
                            <div class="p-3">
                                <h6>{{ $item->title }}</h6>
                                <a href="{{ route('blog.show', $item->slug) }}" class="btn btn-sm btn-gold mt-2">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
