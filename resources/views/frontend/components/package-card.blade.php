<div class="col-lg-4 col-md-6 mb-4">
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

            <a href="{{ route('package.show', $package->slug) }}" class="d-block w-100 h-100">
                <img
                    loading="lazy"
                    src="{{ \App\Helpers\ImageHelper::webp($package->getFirstMediaUrl('packages')) ?: 'https://placehold.co/600x260?text=Package' }}"
                    alt="{{ $package->thumbnail_alt ?? $package->title }}"
                    class="w-100 package-thumb"
                >
            </a>
        </div>

        {{-- Card Details --}}
        <div class="p-4 d-flex flex-column justify-content-between" style="min-height: 240px;">
            <div>
                <h2 class="fw-bold mb-2 text-dark package-title" style="font-size: 1.15rem; line-height: 1.4;">
                    <a href="{{ route('package.show', $package->slug) }}" class="text-decoration-none text-dark hover-success">
                        {{ $package->title }}
                    </a>
                </h2>
                
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
                    <span class="d-flex align-items-center gap-1" style="{{ $package->include_flights ? '' : 'text-decoration: line-through; opacity: 0.5;' }}">
                        <i class="bi bi-airplane-fill {{ $package->include_flights ? 'text-success' : 'text-muted' }}"></i> Flights
                    </span>
                    <span class="d-flex align-items-center gap-1" style="{{ $package->include_hotels ? '' : 'text-decoration: line-through; opacity: 0.5;' }}">
                        <i class="bi bi-building-fill {{ $package->include_hotels ? 'text-success' : 'text-muted' }}"></i> Hotels
                    </span>
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-file-earmark-text-fill text-success"></i> Visa
                    </span>
                    <span class="d-flex align-items-center gap-1" style="{{ $package->include_transport ? '' : 'text-decoration: line-through; opacity: 0.5;' }}">
                        <i class="bi bi-bus-front-fill {{ $package->include_transport ? 'text-success' : 'text-muted' }}"></i> Trans
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                <div>
                    <span class="text-muted small d-block" style="font-size: 0.75rem;">From</span>
                    <span class="fs-4 text-success" style="font-weight: 800;">£{{ rtrim(rtrim((string) $package->price, '0'), '.') ?: '0' }}</span>
                    <span class="text-muted small" style="font-size: 0.75rem;">PP</span>
                </div>

                <div class="d-flex gap-1">
                    <a href="https://wa.me/447380888233" target="_blank" class="btn btn-outline-success btn-sm py-2 px-2.5" title="WhatsApp Us">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="{{ route('package.show', $package->slug) }}" class="btn btn-success px-2.5 fw-semibold shadow-sm btn-sm py-2">
                        View Details <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
