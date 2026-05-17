<section id="packages" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-green">Popular Umrah Packages 2026</h2>
        </div>
        <div class="row">
            @forelse($featuredPackages as $package)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-card h-100">
                        <img src="{{ $package->getFirstMediaUrl('packages') ?: 'https://placehold.co/600x400?text=Package' }}" alt="{{ $package->title }}" class="img-fluid">
                        <div class="p-4">
                            <h5 class="fw-bold">{{ $package->title }}</h5>
                            <p class="text-muted">{{ $package->short_description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-green">£{{ $package->price }}</strong>
                                <a href="#" class="btn btn-sm btn-gold">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No featured packages added yet.</div>
            @endforelse
        </div>
    </div>
</section>
