@extends('frontend.layouts.app')

@section('title', $category->name)
@section('meta_description', 'Browse ' . $category->name . ' for high quality Umrah packages.')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $category->name])

{{-- Horizontal Hero Inquiry Form Card --}}
<section class="bg-light py-4 border-bottom">
    <div class="container">
        <div class="card shadow-sm border-0 rounded-4 p-4 p-md-4" style="background: #ffffff; border: 1px solid rgba(0, 0, 0, 0.05) !important;">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-patch-check-fill text-success me-1"></i> Get a Free Quote for {{ $category->name }} Packages</h5>
            <form action="{{ route('inquiry.store') }}" method="POST">
                @csrf
                <div style="display:none;"><input type="text" name="fax_number" value=""></div>
                <input type="hidden" name="package_type" value="Category page Inquiry ({{ $category->name }})">
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

<section class="section-padding py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-success fw-bold text-uppercase tracking-wider" style="font-size: 0.85rem; letter-spacing: 2px;">Special Selection</span>
            <h2 class="fw-bold text-dark mt-1 mb-2">{{ $category->name }} Packages</h2>
            <p class="text-muted mb-0">Browse pricing and options for {{ $category->name }}</p>
        </div>
        
        <div class="row g-4">
            @forelse($packages as $package)
                @include('frontend.components.package-card')
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4 mb-4">No packages available in this category at the moment.</div>
                    <a href="{{ url('/') }}" class="btn btn-success px-4 py-2.5 fw-semibold shadow-sm">Return Home</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
