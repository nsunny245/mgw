<section id="cities" class="py-4 bg-white">
    <div class="container">
        <h3 class="text-center fw-bold mb-3">Umrah Packages From Your City</h3>

        <div class="row g-3">
            @forelse($cities as $city)
                <div class="col-lg col-md-4 col-6">
                    <a href="{{ route('city.show', $city->slug) }}" class="text-decoration-none">
                        <div class="city-tile position-relative rounded-3 overflow-hidden border shadow-sm">
                            <img loading="lazy" src="https://placehold.co/400x170?text={{ urlencode($city->name) }}" alt="{{ $city->name }}" class="img-fluid w-100">
                            <div class="city-tile-label">{{ $city->name }}</div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No city pages created yet.</div>
            @endforelse

            <div class="col-lg col-md-4 col-12">
                <a href="#" class="text-decoration-none">
                    <div class="city-tile-more rounded-3 h-100 d-flex flex-column justify-content-center align-items-center text-white shadow-sm">
                        <i class="bi bi-building fs-4 mb-1"></i>
                        <strong>More Cities</strong>
                        <small>View All Cities</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
