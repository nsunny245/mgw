<section id="packages" class="section-padding bg-white py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-success fw-bold text-uppercase tracking-wider" style="font-size: 0.85rem; letter-spacing: 2px;">Premium Offers</span>
            <h2 class="fw-bold text-dark mt-1 mb-2">Popular Umrah Packages 2026</h2>
            <p class="text-muted mb-0">All packages include flights, hotels, visa & transportation</p>
        </div>

        <div class="row g-4">
            @forelse($featuredPackages as $package)
                <div class="col-lg-4 col-md-6">
                    <div class="package-card-layout h-100 bg-white overflow-hidden">
                        {{-- Image Wrapper --}}
                        <div class="position-relative overflow-hidden" style="height: 220px;">
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 px-2 py-1.5 small fw-bold shadow-sm" style="z-index: 10;">
                                {{ $package->star_rating ?: 'UMRAH' }}
                            </span>
                            @if(!empty($package->duration))
                                <span class="badge bg-dark text-white position-absolute top-0 end-0 m-3 px-2 py-1.5 small fw-bold shadow-sm" style="z-index: 10;">
                                    <i class="bi bi-clock me-1"></i> {{ $package->duration }}
                                </span>
                            @endif

                            <img
                                loading="lazy"
                                src="{{ $package->getFirstMediaUrl('packages') ?: 'https://placehold.co/600x260?text=Package' }}"
                                alt="{{ $package->title }}"
                                class="w-100 package-thumb"
                            >
                        </div>

                        {{-- Card Details --}}
                        <div class="p-4 d-flex flex-column justify-content-between" style="min-height: 240px;">
                            <div>
                                <h5 class="fw-bold mb-2 text-dark package-title" style="font-size: 1.15rem; line-height: 1.4;">{{ $package->title }}</h5>
                                
                                {{-- Hotels description --}}
                                @if(!empty($package->makkah_hotel) || !empty($package->madinah_hotel))
                                    <div class="text-muted small mb-3 d-flex align-items-center gap-1">
                                        <i class="bi bi-geo-alt-fill text-success"></i>
                                        <span class="text-truncate">
                                            {{ $package->makkah_hotel ?? 'Makkah' }} & {{ $package->madinah_hotel ?? 'Madinah' }}
                                        </span>
                                    </div>
                                @else
                                    <div class="text-muted small mb-3"><i class="bi bi-geo-alt-fill text-success"></i> {{ $package->departure_city ?: 'Departure from UK' }}</div>
                                @endif

                                {{-- Features badges --}}
                                <div class="d-flex justify-content-between gap-1 text-secondary mb-4 bg-light py-2 px-3 rounded-3" style="font-size: 0.78rem; font-weight: 500;">
                                    <span class="d-flex align-items-center gap-1"><i class="bi bi-airplane-fill text-success"></i> Flights</span>
                                    <span class="d-flex align-items-center gap-1"><i class="bi bi-building-fill text-success"></i> Hotels</span>
                                    <span class="d-flex align-items-center gap-1"><i class="bi bi-file-earmark-text-fill text-success"></i> Visa</span>
                                    <span class="d-flex align-items-center gap-1"><i class="bi bi-bus-front-fill text-success"></i> Trans</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <div>
                                    <span class="text-muted small d-block" style="font-size: 0.75rem;">From</span>
                                    <span class="fs-4 text-success" style="font-weight: 800;">£{{ rtrim(rtrim((string) $package->price, '0'), '.') ?: '0' }}</span>
                                    <span class="text-muted small" style="font-size: 0.75rem;">PP</span>
                                </div>

                                <a href="{{ route('package.show', $package->slug) }}" class="btn btn-success px-3 fw-semibold shadow-sm btn-sm py-2">
                                    View Details <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">No featured packages added yet.</div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn btn-success px-4 py-2.5 fw-semibold shadow-sm">View All Packages</a>
        </div>
    </div>
</section>

<style>
.package-card-layout {
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
}
.package-card-layout:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 35px rgba(0, 0, 0, 0.08);
}
.package-thumb {
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.package-card-layout:hover .package-thumb {
    transform: scale(1.08);
}
.package-title {
    transition: color 0.2s ease;
}
.package-card-layout:hover .package-title {
    color: #198754; /* success color */
}
</style>
