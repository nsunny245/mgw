@extends('frontend.layouts.app')

@section('title', 'Makkah Gateway - Best Umrah Packages from UK')
@section('meta_description', 'Affordable Umrah packages from UK with ATOL protection, luxury hotels, flights and visa support.')

@section('content')
    @include('frontend.partials.hero')

    <section class="section-block py-4" id="packages">
        <div class="container">
            <h2 class="section-title text-center mb-1">Popular Umrah Packages 2026</h2>
            <p class="section-sub text-center mb-4">All packages include flights, hotels, visa & transportation</p>
            <div class="row g-3">
                <div class="col-md-4"><div class="pkg-card"><img src="https://placehold.co/420x170" class="img-fluid"><div class="p-2"><h6>7 Nights 3 Star Umrah</h6><div class="d-flex justify-content-between"><strong>From £695 pp</strong><button class="btn btn-sm btn-success">View Details</button></div></div></div></div>
                <div class="col-md-4"><div class="pkg-card"><img src="https://placehold.co/420x170" class="img-fluid"><div class="p-2"><h6>10 Nights 4 Star Umrah</h6><div class="d-flex justify-content-between"><strong>From £895 pp</strong><button class="btn btn-sm btn-success">View Details</button></div></div></div></div>
                <div class="col-md-4"><div class="pkg-card"><img src="https://placehold.co/420x170" class="img-fluid"><div class="p-2"><h6>14 Nights 5 Star Umrah</h6><div class="d-flex justify-content-between"><strong>From £1,195 pp</strong><button class="btn btn-sm btn-success">View Details</button></div></div></div></div>
            </div>
            <div class="text-center mt-3"><a href="#" class="btn btn-outline-success btn-sm px-4">View All Packages</a></div>
        </div>
    </section>

    <section class="section-block py-4 bg-white">
        <div class="container text-center">
            <h3 class="section-title mb-3">Why Choose Makkah Gateway?</h3>
            <div class="row g-3 why-grid">
                <div class="col"><i class="bi bi-building"></i><h6>UK Based Company</h6></div>
                <div class="col"><i class="bi bi-tag"></i><h6>Best Price Guarantee</h6></div>
                <div class="col"><i class="bi bi-shield-check"></i><h6>ATOL Protected</h6></div>
                <div class="col"><i class="bi bi-headset"></i><h6>24/7 Support</h6></div>
                <div class="col"><i class="bi bi-sliders"></i><h6>Custom Packages</h6></div>
            </div>
        </div>
    </section>

    <section class="testi-band py-3">
        <div class="container">
            <h3 class="text-center text-white mb-3">What Our Customers Say</h3>
            <div class="row g-3">
                <div class="col-md-4"><div class="testi-card p-3">Excellent service and smooth experience.</div></div>
                <div class="col-md-4"><div class="testi-card p-3">Great staff and very supportive team.</div></div>
                <div class="col-md-4"><div class="testi-card p-3">Very professional and trustworthy services.</div></div>
            </div>
        </div>
    </section>

    <section class="section-block py-4" id="cities">
        <div class="container">
            <h3 class="section-title text-center mb-3">Umrah Packages From Your City</h3>
            <div class="row g-2 city-row">
                <div class="col-md"><div class="city-box">London</div></div>
                <div class="col-md"><div class="city-box">Birmingham</div></div>
                <div class="col-md"><div class="city-box">Manchester</div></div>
                <div class="col-md"><div class="city-box">Bradford</div></div>
                <div class="col-md"><div class="city-box city-more">More Cities</div></div>
            </div>
        </div>
    </section>

    <section class="cta-strip py-2">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
            <strong class="text-white">Ready to Start Your Spiritual Journey?</strong>
            <div class="d-flex gap-2"><a class="btn btn-light btn-sm" href="#">0203 411 1934</a><a class="btn btn-warning btn-sm" href="#">Chat on WhatsApp</a></div>
        </div>
    </section>

    <section class="section-block py-4" id="blogs">
        <div class="container">
            <h3 class="section-title text-center mb-3">Latest From Our Blog</h3>
            <div class="row g-3">
                <div class="col-md-4"><div class="blog-card"><img src="https://placehold.co/420x180" class="img-fluid"><div class="p-2"><h6>Umrah Guide 2026</h6><a href="#">Read More</a></div></div></div>
                <div class="col-md-4"><div class="blog-card"><img src="https://placehold.co/420x180" class="img-fluid"><div class="p-2"><h6>Best Time for Umrah</h6><a href="#">Read More</a></div></div></div>
                <div class="col-md-4"><div class="blog-card"><img src="https://placehold.co/420x180" class="img-fluid"><div class="p-2"><h6>Umrah Visa Process</h6><a href="#">Read More</a></div></div></div>
            </div>
        </div>
    </section>

    <footer class="site-footer py-4">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-3">Makkah Gateway</div>
                <div class="col-md-2">Quick Links</div>
                <div class="col-md-2">Top Packages</div>
                <div class="col-md-2">City Packages</div>
                <div class="col-md-3">Contact Info</div>
            </div>
        </div>
    </footer>
@endsection
