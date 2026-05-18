<div class="col-lg-4 mb-4">
    <div class="package-card">
        <img src="{{ $package->getFirstMediaUrl('packages') ?: 'https://placehold.co/600x350?text=Package' }}" class="img-fluid" alt="{{ $package->title }}">
        <div class="p-4">
            <h5 class="fw-bold">{{ $package->title }}</h5>
            <p>£{{ $package->price }}</p>
            <a href="{{ route('package.show', $package->slug) }}" class="btn btn-gold">View Details</a>
        </div>
    </div>
</div>
