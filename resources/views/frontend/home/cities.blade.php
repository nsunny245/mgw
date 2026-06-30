<section id="cities" class="py-4 bg-white">
    <div class="container">
        <h3 class="text-center fw-bold mb-3">Umrah Packages From Your City</h3>

            @php
                $cityLandmarks = [
                    'london' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=400&h=170&q=80',
                    'manchester' => 'https://images.unsplash.com/photo-1573843221490-671c667464d2?auto=format&fit=crop&w=400&h=170&q=80',
                    'birmingham' => 'https://images.unsplash.com/photo-1607990283143-e81e7a2c93ab?auto=format&fit=crop&w=400&h=170&q=80',
                    'bradford' => 'https://images.unsplash.com/photo-1569336415962-a4bd9f69cd83?auto=format&fit=crop&w=400&h=170&q=80',
                ];
            @endphp
            @forelse($cities as $city)
                @php
                    $cleanSlug = trim(strtolower($city->slug));
                    $imageSrc = $cityLandmarks[$cleanSlug] ?? 'https://placehold.co/400x170?text=' . urlencode($city->name);
                @endphp
                <div class="col-lg col-md-4 col-6">
                    <a href="{{ route('city.show', $city->slug) }}" class="text-decoration-none">
                        <div class="city-tile position-relative rounded-3 overflow-hidden border shadow-sm">
                            <img loading="lazy" src="{{ $imageSrc }}" alt="{{ $city->name }}" class="img-fluid w-100" style="height: 120px; object-fit: cover;">
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
