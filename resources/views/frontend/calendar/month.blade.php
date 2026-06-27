@extends('frontend.layouts.app')

@section('title', $monthName . ' Umrah Packages')
@section('meta_description', 'Compare and find the best Umrah packages departing in ' . $monthName)

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $monthName . ' Packages'])

<section class="section-padding py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">{{ $monthName }} Umrah Packages</h1>
        <p class="text-muted mb-5">Browse the custom calendar schedules, hotel standard ratings, and rates for packages scheduled during the month of {{ $monthName }}.</p>
        
        <div class="row g-4">
            @forelse($schedules as $schedule)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                        <img src="{{ $schedule->package->getFirstMediaUrl('packages') ?: 'https://placehold.co/600x350?text=Umrah' }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $schedule->package->title }}">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="badge bg-success mb-2 align-self-start">{{ $schedule->package->category->name ?? 'Umrah' }}</span>
                            <h5 class="fw-bold card-title mb-3">{{ $schedule->package->title }}</h5>
                            
                            <div class="mb-3 text-muted small">
                                <div><i class="bi bi-clock-fill text-success"></i> <strong>Duration:</strong> {{ $schedule->package->duration }} Days</div>
                                <div><i class="bi bi-geo-alt-fill text-success"></i> <strong>Departing from:</strong> {{ $schedule->package->departure_city ?? 'UK Airport' }}</div>
                                @if($schedule->start_date && $schedule->end_date)
                                    <div><i class="bi bi-calendar-check-fill text-success"></i> <strong>Travel Period:</strong> {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}</div>
                                @endif
                            </div>

                            @if($schedule->notes)
                                <div class="alert alert-light p-2 small mb-3 border-0 bg-light">{{ $schedule->notes }}</div>
                            @endif

                            <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                                <div>
                                    <span class="text-muted small d-block">Price from</span>
                                    <span class="fs-4 fw-bold text-success">£{{ number_format($schedule->price, 0) }}</span>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $schedule->status === 'Available' ? 'success' : ($schedule->status === 'Filling Fast' ? 'warning' : 'danger') }} d-block mb-2">{{ $schedule->status }}</span>
                                    <a href="{{ route('package.show', $schedule->package->slug) }}?month={{ strtolower($monthName) }}" class="btn btn-warning btn-sm fw-semibold">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4 mb-3">No packages are scheduled for {{ $monthName }} at the moment.</div>
                    <a href="{{ url('/') }}" class="btn btn-primary">Return Home</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
