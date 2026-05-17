<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-green">What Our Pilgrims Say</h2>
        </div>
        <div class="row">
            @forelse($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="bg-white border rounded p-4 h-100">
                        <h6 class="fw-bold mb-1">{{ $testimonial->name }}</h6>
                        <small class="text-muted d-block mb-2">{{ $testimonial->city }}</small>
                        <p class="text-muted mb-2">{{ $testimonial->review }}</p>
                        <small class="text-warning">Rating: {{ $testimonial->rating }}/5</small>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No testimonials available yet.</div>
            @endforelse
        </div>
    </div>
</section>
