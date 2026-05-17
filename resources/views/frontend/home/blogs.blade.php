<section id="blogs" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-green">Latest Umrah Blogs</h2>
        </div>
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card h-100">
                        <img src="{{ $blog->getFirstMediaUrl('blogs') ?: 'https://placehold.co/600x400?text=Blog' }}" alt="{{ $blog->title }}" class="img-fluid">
                        <div class="p-4">
                            <h5 class="fw-bold">{{ $blog->title }}</h5>
                            <p class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 110) }}</p>
                            <a href="#" class="btn btn-sm btn-gold">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No blogs published yet.</div>
            @endforelse
        </div>
    </div>
</section>
