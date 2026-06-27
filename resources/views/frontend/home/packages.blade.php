<section id="packages" class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark mb-1">Popular Umrah Packages 2026</h2>
            <p class="text-muted mb-0">All packages include flights, hotels, visa & transportation</p>
        </div>

        <div class="row g-3">
            @forelse($featuredPackages as $package)
                <div class="col-lg-4 col-md-6">
                    <div class="package-card-layout h-100 border rounded-3 bg-white overflow-hidden shadow-sm">
                        <div class="position-relative">
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 px-2 py-1 small">
                                {{ $loop->first ? 'MOST POPULAR' : 'PACKAGE' }}
                            </span>

                            <img
                                loading="lazy"
                                src="{{ $package->getFirstMediaUrl('packages') ?: 'https://placehold.co/600x260?text=Package' }}"
                                alt="{{ $package->title }}"
                                class="img-fluid w-100 package-thumb"
                            >
                        </div>

                        <div class="p-3">
                            <h5 class="fw-bold text-center mb-1 package-title">{{ $package->title }}</h5>
                            <p class="text-center text-muted small mb-2">{{ $package->departure_city ?: 'Makkah & Madinah' }}</p>

                            <div class="d-flex justify-content-center flex-wrap gap-3 small text-muted mb-3 align-items-center">
                                <span><i class="bi bi-airplane fs-5 text-success"></i> Flights</span>
                                <span><i class="bi bi-building fs-5 text-success"></i> Hotels</span>
                                <span><i class="bi bi-file-earmark-text fs-5 text-success"></i> Visa</span>
                                <span><i class="bi bi-bus-front fs-5 text-success"></i> Transport</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-dark fw-semibold">From</span>
                                    <strong class="ms-1">£{{ rtrim(rtrim((string) $package->price, '0'), '.') ?: '0' }}</strong>
                                    <small class="text-muted">PP</small>
                                </div>

                                <a href="{{ route('package.show', $package->slug) }}" class="btn btn-success btn-sm px-3">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No featured packages added yet.</div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-success px-4">View All Packages</a>
        </div>
    </div>
</section>
