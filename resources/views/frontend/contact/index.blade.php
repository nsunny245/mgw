@extends('frontend.layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? 'Contact Us')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $page->title])

<style>
    .contact-card {
        border: 1px solid #eef2f5;
        border-radius: 16px;
        background: #fff;
        padding: 35px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.02);
        height: 100%;
    }
    .contact-info-list i {
        font-size: 24px;
        color: #0b4f36;
        margin-right: 15px;
    }
</style>

<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left Info Column -->
            <div class="col-lg-5">
                <div class="contact-card">
                    <div class="mb-4">
                        {!! $page->content ?? '<h3>How can we help you?</h3><p>Contact us for solutions, suggestions, and assistance.</p>' !!}
                    </div>

                    <div class="contact-info-list">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Office Address</h6>
                                <small class="text-muted">Beacon House, Stokenchurch, High Wycombe, HP14 3FE, UK</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Phone Number</h6>
                                <a href="tel:02034111934" class="text-dark text-decoration-none small">0203 411 1934</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Email Address</h6>
                                <a href="mailto:info@makkahgateway.co.uk" class="text-dark text-decoration-none small">info@makkahgateway.co.uk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Message Form Column -->
            <div class="col-lg-7">
                <div class="contact-card">
                    <h3 class="fw-bold mb-3">Send Us a Message</h3>
                    <p class="text-muted small mb-4">Complete the form below and a representative will follow up with your inquiry shortly.</p>
                    
                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_type" value="Contact Us Submission">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Full Name</label>
                            <input type="text" name="name" class="form-control py-2" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Phone Number</label>
                            <input type="text" name="phone" class="form-control py-2" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control py-2" placeholder="Email Address" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Message</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Enter your query details..." required></textarea>
                        </div>
                        <button class="btn btn-warning py-3 px-5 fw-bold text-dark rounded-3">SUBMIT MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
