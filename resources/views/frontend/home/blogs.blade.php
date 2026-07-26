<section id="blogs" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark mb-1">Latest From Our Blog</h3>
            <p class="text-muted mb-0">Discover helpful tips, guides, and news for your spiritual journey</p>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="d-block overflow-hidden" style="height: 200px;">
                            <img loading="lazy" 
                                 src="{{ \App\Helpers\ImageHelper::webp($blog->getFirstMediaUrl('blogs')) ?: 'https://placehold.co/640x280?text=Blog+Image' }}" 
                                 alt="{{ $blog->thumbnail_alt ?? $blog->title }}" 
                                 class="w-100 h-100 object-fit-cover transition-transform"
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
                                <h4 class="card-title fw-bold text-dark mb-3" style="font-size: 1.1rem; line-height: 1.4;">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark hover-success">{{ \Illuminate\Support\Str::limit($blog->title, 55) }}</a>
                                </h4>
                            </div>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-success w-100 fw-bold py-2 mt-3 shadow-sm" style="border-radius: 8px; font-size: 0.9rem;">
                                Read Article <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No blogs published yet.</div>
            @endforelse
        </div>
    </div>
</section>
