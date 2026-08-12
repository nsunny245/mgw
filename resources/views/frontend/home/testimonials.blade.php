<section class="py-4" style="background:#0e603e;">
    <div class="container">
        <h3 class="text-center text-white fw-bold mb-3">See Why Our Customers Recommend Makkah Gateway</h3>
        <p class="text-center text-white-50 mx-auto mb-4" style="max-width: 800px; font-size: clamp(15px, 2vw, 18px); line-height: 1.6;">We are proud to have helped thousands of pilgrims travel to Makkah and Madinah with confidence. Here's what some of our customers have shared about their experience with Makkah Gateway.</p>

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
