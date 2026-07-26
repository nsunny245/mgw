@extends('frontend.layouts.app')

@section('title', 'Umrah Travel Blog')
@section('meta_description', 'Latest Umrah travel tips and guides')

@section('content')
<section class="section-padding">
    <div class="container">
        <h1 class="fw-bold mb-5">Umrah Travel Blog</h1>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="d-block overflow-hidden" style="height: 220px;">
                            <img src="{{ \App\Helpers\ImageHelper::webp($blog->getFirstMediaUrl('blogs')) ?: 'https://placehold.co/600x350?text=Blog' }}" 
                                 class="w-100 h-100 object-fit-cover transition-transform" 
                                 alt="{{ $blog->thumbnail_alt ?? $blog->title }}"
                                 style="transition: transform 0.4s ease;"
                                 onmouseover="this.style.transform='scale(1.06)'"
                                 onmouseout="this.style.transform='scale(1)'"
                            >
                        </a>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-light text-success fw-bold px-2.5 py-1.5 mb-2.5" style="font-size: 0.75rem;">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $blog->created_at->format('M d, Y') }}
                                </span>
                                <h2 class="card-title fw-bold text-dark mb-3" style="font-size: 1.15rem; line-height: 1.4;">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark hover-success">{{ $blog->title }}</a>
                                </h2>
                            </div>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-success w-100 fw-bold py-2 mt-3 shadow-sm" style="border-radius: 8px; font-size: 0.9rem;">
                                Read Article <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $blogs->links() }}
    </div>
</section>
@endsection
