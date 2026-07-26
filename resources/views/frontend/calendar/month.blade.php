@extends('frontend.layouts.app')

@section('title', $monthName . ' Umrah Packages')
@section('meta_description', 'Compare and find the best Umrah packages departing in ' . $monthName . ' with direct flights and hotels.')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $monthName . ' Packages'])

{{-- Horizontal Hero Inquiry Form Card --}}
<section class="bg-light py-4 border-bottom">
    <div class="container">
        <div class="card shadow-sm border-0 rounded-4 p-4 p-md-4" style="background: #ffffff; border: 1px solid rgba(0, 0, 0, 0.05) !important;">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-patch-check-fill text-success me-1"></i> Get a Free Quote for {{ $monthName }} Umrah Packages</h5>
            <form action="{{ route('inquiry.store') }}" method="POST">
                @csrf
                <div style="display:none;"><input type="text" name="fax_number" value=""></div>
                <input type="hidden" name="package_type" value="Monthly page Inquiry ({{ $monthName }})">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-2 col-md-6 col-12">
                        <label class="form-label small mb-1 fw-bold text-secondary">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required style="height: 46px; border-radius: 8px; border: 1px solid #d7dde5;">
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <label class="form-label small mb-1 fw-bold text-secondary">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone" required style="height: 46px; border-radius: 8px; border: 1px solid #d7dde5;">
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <label class="form-label small mb-1 fw-bold text-secondary">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required style="height: 46px; border-radius: 8px; border: 1px solid #d7dde5;">
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <label class="form-label small mb-1 fw-bold text-secondary">Departure City (Optional)</label>
                        <select class="form-select" name="city" style="height: 46px; border-radius: 8px; border: 1px solid #d7dde5;">
                            <option value="">Select City</option>
                            @foreach(\App\Models\City::all() as $c)
                                <option value="{{ $c->name }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <label class="form-label small mb-1 fw-bold text-secondary">Persons (Optional)</label>
                        <select class="form-select" name="persons" style="height: 46px; border-radius: 8px; border: 1px solid #d7dde5;">
                            <option value="">Persons</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            <option value="8+">8+</option>
                        </select>
                    </div>
                    <div class="col-lg col-md-6 col-12">
                        <label class="form-label small mb-1 fw-bold text-secondary">Travel Date (Optional)</label>
                        <input type="date" name="travel_date" class="form-control" style="height: 46px; border-radius: 8px; border: 1px solid #d7dde5;">
                    </div>
                    <div class="col-lg-auto col-md-12 col-12">
                        <button type="submit" class="btn btn-success fw-bold w-100 px-4 text-uppercase" style="height: 46px; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">Get Quote</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Redesigned Monthly Packages Grid --}}
<section class="section-padding py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-success fw-bold text-uppercase tracking-wider" style="font-size: 0.85rem; letter-spacing: 2px;">{{ $monthName }} Schedules</span>
            <h2 class="fw-bold text-dark mt-1 mb-2">Umrah Packages Scheduled For {{ $monthName }}</h2>
            <p class="text-muted mb-0">Browse specific calendar schedules, hotels, and custom rates</p>
        </div>

        <div class="row g-4">
            @forelse($schedules as $schedule)
                @php
                    $package = $schedule->package;
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="package-card-layout h-100 bg-white overflow-hidden">
                        {{-- Image Wrapper --}}
                        <div class="position-relative overflow-hidden" style="height: 220px;">
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 px-2 py-1.5 small fw-bold shadow-sm" style="z-index: 10;">
                                {{ $package->star_rating ?: 'UMRAH' }}
                            </span>
                            @if(!empty($package->duration))
                                <span class="badge bg-dark text-white position-absolute top-0 end-0 m-3 px-2 py-1.5 small fw-bold shadow-sm" style="z-index: 10;">
                                    <i class="bi bi-clock me-1"></i> {{ $package->duration }} Days
                                </span>
                            @endif

                            <a href="{{ route('package.show', $package->slug) }}?month={{ strtolower($monthName) }}" class="d-block w-100 h-100">
                                <img
                                    loading="lazy"
                                    src="{{ \App\Helpers\ImageHelper::webp($package->getFirstMediaUrl('packages')) ?: 'https://placehold.co/600x260?text=Package' }}"
                                    alt="{{ $package->thumbnail_alt ?? $package->title }}"
                                    class="w-100 package-thumb"
                                >
                            </a>
                        </div>

                        {{-- Card Details --}}
                        <div class="p-4 d-flex flex-column justify-content-between" style="min-height: 250px;">
                            <div>
                                <h2 class="fw-bold mb-2 text-dark package-title" style="font-size: 1.15rem; line-height: 1.4;">
                                    <a href="{{ route('package.show', $package->slug) }}?month={{ strtolower($monthName) }}" class="text-decoration-none text-dark hover-success">
                                        {{ $package->title }}
                                    </a>
                                </h2>
                                
                                {{-- Departure details --}}
                                <div class="text-muted small mb-2 d-flex align-items-center gap-1">
                                    <i class="bi bi-geo-alt-fill text-success"></i>
                                    <span class="text-truncate">
                                        {{ $package->makkah_hotel ?? 'Makkah' }} & {{ $package->madinah_hotel ?? 'Madinah' }}
                                    </span>
                                </div>
                                <div class="text-muted small mb-3">
                                    <i class="bi bi-airplane-fill text-success"></i> Departure: {{ $package->departure_city ?? 'UK' }}
                                </div>

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
                                    <span class="fs-4 text-success" style="font-weight: 800;">£{{ number_format($schedule->price, 0) }}</span>
                                    <span class="text-muted small" style="font-size: 0.75rem;">PP</span>
                                </div>

                                <div class="d-flex gap-1">
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings->phone ?? '02034111934') }}" class="btn btn-outline-success btn-sm py-2 px-2.5" title="Call Us">
                                        <i class="bi bi-telephone-fill"></i>
                                    </a>
                                    <a href="{{ route('package.show', $package->slug) }}?month={{ strtolower($monthName) }}" class="btn btn-success px-2.5 fw-semibold shadow-sm btn-sm py-2">
                                        View Details <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4 mb-4">No packages are scheduled for {{ $monthName }} at the moment.</div>
                    <a href="{{ url('/') }}" class="btn btn-success px-4 py-2.5 fw-semibold shadow-sm">Return Home</a>
                </div>
            @endforelse
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
.package-title a {
    transition: color 0.2s ease;
}
.package-title a:hover {
    color: #198754 !important;
}
</style>
@endsection
