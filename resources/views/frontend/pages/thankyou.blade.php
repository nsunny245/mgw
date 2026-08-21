@extends('frontend.layouts.app')

@section('title', 'Thank You | Makkah Gateway')
@section('meta_description', 'Thank you for your interest in Makkah Gateway. Our team will contact you shortly.')

@section('content')
<section class="d-flex align-items-center justify-content-center py-5 bg-light" style="min-height: 60vh;">
    <div class="container text-center">
        <div class="card border-0 shadow-sm rounded-4 p-5 mx-auto" style="max-width: 600px; background: #ffffff;">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle" style="width: 80px; height: 80px;">
                    <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                </div>
            </div>
            <h1 class="fw-bold text-dark mb-3">Thank You!</h1>
            <p class="text-muted fs-5 mb-4">Your inquiry has been successfully received. A representative from our team will follow up with you shortly to assist with your Umrah pilgrimage query.</p>
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                <a href="{{ url('/') }}" class="btn btn-success px-4 py-2.5 fw-bold rounded-3">Return Home</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-secondary px-4 py-2.5 fw-bold rounded-3">Contact Us Directly</a>
            </div>
        </div>
    </div>
</section>

<script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        'event': 'mgw_quote_submitted'
    });
</script>
@endsection
