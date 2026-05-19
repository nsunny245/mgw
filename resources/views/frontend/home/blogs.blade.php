<section id="blogs" class="py-4 bg-white">
    <div class="container">
        <h3 class="text-center fw-bold mb-3">Latest From Our Blog</h3>

        <div class="row g-3">
            @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="package-card h-100 border rounded-3 overflow-hidden shadow-sm">
                        <img loading="lazy" src="{{ $blog->getFirstMediaUrl('blogs') ?: 'https://placehold.co/640x280?text=Blog+Image' }}" alt="{{ $blog->title }}" class="img-fluid w-100">
                        <div class="p-3">
                            <h6 class="fw-bold mb-2">{{ \Illuminate\Support\Str::limit($blog->title, 55) }}</h6>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="small text-decoration-none">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No blogs published yet.</div>
            @endforelse
        </div>
    </div>
</section>
