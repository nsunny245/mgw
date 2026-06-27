@extends('frontend.layouts.app')

@section('title', 'Disclaimer - Makkah Gateway')
@section('meta_description', 'Review the Makkah Gateway booking disclaimer, liability limits, and health protection guidelines.')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => 'Disclaimer'])

<style>
    .disclaimer-section {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #eef2f5;
        padding: 35px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.02);
        margin-bottom: 30px;
    }
    .disclaimer-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #b45309; /* Deep Amber */
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    .disclaimer-title i {
        margin-right: 12px;
        font-size: 1.4rem;
    }
    .disclaimer-text {
        font-size: 0.95rem;
        line-height: 1.7;
        color: #4b5563;
        text-align: justify;
    }
    .disclaimer-grid {
        background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
        border-left: 5px solid #d97706;
    }
</style>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="badge bg-danger text-white px-3 py-2 fs-6 rounded-pill mb-3 fw-bold">LIABILITY LIMITATION</span>
                <h2 class="fw-bold text-dark mb-3">Disclaimer & Travel Advisory</h2>
                <p class="text-muted">Important details regarding third-party service limitations, baggage safety responsibilities, destination policies, and local regulations.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Section 1 -->
                <div class="disclaimer-section">
                    <h3 class="disclaimer-title">
                        <i class="bi bi-shield-slash"></i> 1. Scope of Responsibility
                    </h3>
                    <p class="disclaimer-text">
                        While we take reasonable care to ensure accuracy, we cannot guarantee information exactness as details are sourced from third-party suppliers. Makkah Gateway acts as an agent and has no direct control over independent transport companies, airlines, or hotels. Bookings are subject to the terms and conditions of those respective service providers.
                    </p>
                </div>

                <!-- Section 2 -->
                <div class="disclaimer-section">
                    <h3 class="disclaimer-title">
                        <i class="bi bi-exclamation-triangle"></i> 2. Force Majeure & Cancellations
                    </h3>
                    <p class="disclaimer-text">
                        The Company is not responsible for cancellations, delays, or booking modifications caused by circumstances beyond our control. This includes war, civil disturbances, strikes, flight schedule alterations, natural disasters, weather events, epidemics, or regulatory changes introduced by UK or Saudi authorities.
                    </p>
                </div>

                <!-- Section 3 -->
                <div class="disclaimer-section">
                    <h3 class="disclaimer-title">
                        <i class="bi bi-safe"></i> 3. Personal Items & Documentation
                    </h3>
                    <p class="disclaimer-text">
                        All personal belongings—including luggage, bags, money, medicines, electronics, and valuables—are at the owner's risk at all times. It is the passenger's sole responsibility to secure and verify passport expiration dates and ensure visa documentation matches travel dates. We strongly suggest securing travel insurance.
                    </p>
                </div>

                <!-- Section 4 -->
                <div class="disclaimer-section">
                    <h3 class="disclaimer-title">
                        <i class="bi bi-heart-pulse"></i> 4. Health & Safety Advisory
                    </h3>
                    <p class="disclaimer-text">
                        International travel involves exposure to crowds, viruses, and environmental changes. The Company cannot be held liable for personal accidents, health emergencies, illness, or death during travel. Destination health regulations and safety policies supersede UK guidelines.
                    </p>
                </div>

                <!-- Section 5 -->
                <div class="disclaimer-section disclaimer-grid p-4 rounded-4 shadow-sm">
                    <h3 class="disclaimer-title text-amber-900">
                        <i class="bi bi-info-circle-fill"></i> Local Authority Authority
                    </h3>
                    <p class="disclaimer-text text-amber-800 mb-0">
                        Local destination authorities are exclusively responsible for scheduling transport shuttles and managing pilgrim logistics. While our local representatives will assist with language barriers and transport inquiries, Makkah Gateway cannot control scheduling changes or accommodations quality at the destination.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
