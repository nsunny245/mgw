<section id="cities" class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-green">Umrah Packages by City</h2>
        </div>
        <div class="row">
            @forelse($cities as $city)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="city-card bg-white h-100">
                        <img src="https://placehold.co/600x300?text={{ urlencode($city->name) }}" alt="{{ $city->name }}" class="img-fluid">
                        <div class="p-3 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">{{ $city->name }}</h6>
                            <a href="#" class="btn btn-sm btn-gold">Explore</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No city pages created yet.</div>
            @endforelse
        </div>
    </div>
</section>
