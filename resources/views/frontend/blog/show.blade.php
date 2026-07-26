@extends('frontend.layouts.app')

@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? 'Umrah blog')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $blog->title])

<section class="section-padding">
    <div class="container">
        <img src="{{ \App\Helpers\ImageHelper::webp($blog->getFirstMediaUrl('blogs')) ?: 'https://placehold.co/900x500?text=Blog' }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
        <h1 class="fw-bold mb-4">{{ $blog->title }}</h1>
        {!! $blog->content !!}

        @if(isset($relatedBlogs) && $relatedBlogs->count())
            <hr class="my-5">
            <h3 class="fw-bold mb-4">Related Blogs</h3>
            <div class="row">
                @foreach($relatedBlogs as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <a href="{{ route('blog.show', $item->slug) }}" class="d-block overflow-hidden" style="height: 180px;">
                                <img src="{{ \App\Helpers\ImageHelper::webp($item->getFirstMediaUrl('blogs')) ?: 'https://placehold.co/600x350?text=Blog' }}" 
                                     class="w-100 h-100 object-fit-cover transition-transform" 
                                     alt="{{ $item->thumbnail_alt ?? $item->title }}"
                                     style="transition: transform 0.4s ease;"
                                     onmouseover="this.style.transform='scale(1.06)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                >
                            </a>
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge bg-light text-success fw-bold px-2.5 py-1.5 mb-2.5" style="font-size: 0.75rem;">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $item->created_at->format('M d, Y') }}
                                    </span>
                                    <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1.05rem; line-height: 1.4;">
                                        <a href="{{ route('blog.show', $item->slug) }}" class="text-decoration-none text-dark hover-success">{{ \Illuminate\Support\Str::limit($item->title, 45) }}</a>
                                    </h5>
                                </div>
                                <a href="{{ route('blog.show', $item->slug) }}" class="btn btn-success w-100 fw-bold py-2 mt-2.5 shadow-sm" style="border-radius: 8px; font-size: 0.85rem;">
                                    Read Article <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
