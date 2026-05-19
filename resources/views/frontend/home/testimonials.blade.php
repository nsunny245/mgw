<section class="py-4" style="background:#0e603e;">
    <div class="container">
        <h3 class="text-center text-white fw-bold mb-3">What Our Customers Say</h3>

        <div class="row g-3">
            @forelse($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6">
                    <div class="bg-white border rounded-3 p-3 h-100 shadow-sm">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <img loading="lazy" src="https://placehold.co/54x54?text=U" alt="{{ $testimonial->name }}" class="rounded-circle" width="54" height="54">
                            <div>
                                <h6 class="fw-bold mb-0">{{ $testimonial->name }}</h6>
                                <small class="text-muted">{{ $testimonial->city ?: 'UK' }}</small>
                            </div>
                        </div>
                        <p class="mb-1 small text-muted">{{ \Illuminate\Support\Str::limit($testimonial->review, 170) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white-50">No testimonials available yet.</div>
            @endforelse
        </div>
    </div>
</section>
