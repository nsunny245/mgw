@extends('frontend.layouts.app')

@section('title', 'Terms & Conditions - Makkah Gateway')
@section('meta_description', 'Read Makkah Gateway Hajj and Umrah terms, visa rules, cancellations, and booking policies.')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => 'Terms & Conditions'])

<style>
    .terms-card {
        border: 1px solid #eef2f5;
        border-radius: 16px;
        background: #fff;
        padding: 30px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border-top: 4px solid #d97706; /* Amber-600 */
    }
    .terms-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(217, 119, 6, 0.08);
    }
    .terms-icon {
        width: 48px;
        height: 48px;
        background: rgba(217, 119, 6, 0.1);
        color: #d97706;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.3rem;
    }
    .terms-card h4 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 12px;
    }
    .terms-card p {
        font-size: 0.92rem;
        line-height: 1.6;
        color: #4b5563;
        margin-bottom: 0;
    }
    .quick-alert-box {
        border-left: 4px solid #d97706;
        background-color: #fef3c7;
        color: #92400e;
        border-radius: 0 8px 8px 0;
        padding: 15px 20px;
        font-size: 0.95rem;
    }
</style>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="badge bg-warning text-dark px-3 py-2 fs-6 rounded-pill mb-3 fw-bold">LEGAL AGREEMENT</span>
                <h2 class="fw-bold text-dark mb-3">Hajj & Umrah Booking Terms</h2>
                <p class="text-muted">Please review these terms thoroughly before completing your reservation. Emitting tickets or payments constitutes acceptance of the rules outlined below.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h4>1. Terms of Use</h4>
                    <p>By booking a tour, flight, accommodation, travel advice, or any service with Makkah Gateway, you agree to abide by our Terms & Conditions. Upon receipt of tickets, check details immediately and inform us of any discrepancies.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h4>2. Visa Application</h4>
                    <p>Passports must be valid for at least 6 months, contain two blank facing pages, and be digital. Non-EC passport holders must demonstrate a work/student visa and permanent UK residency to satisfy requirements.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <h4>3. Prices & Rates</h4>
                    <p>Makkah Gateway reserves the right to adjust package prices without prior notice. Airline ticket prices, government surcharges, and supplier changes may affect the package price until fully tickets are issued.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h4>4. Accommodations</h4>
                    <p>We reserve the right to provide alternative hotels of equivalent standard if agreed options are unavailable. Hotels are solely responsible for the quality of services and room setup guidelines.</p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h4>5. Deposits & Payments</h4>
                    <p>A deposit of 50% of the total package value is required to secure your booking. Fares and ticket rates are not locked or guaranteed until the full outstanding balance is cleared.</p>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <h4>6. Cancellations & Changes</h4>
                    <p>Flight tickets are non-refundable after cancellation. A 50% admin fee applies to deposits for cancellations made before ticket issuance. Remaining vouchers are subject to non-refundable supplier terms.</p>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-airplane"></i>
                    </div>
                    <h4>7. Flight Tickets</h4>
                    <p>We advise reconfirming your flights 72 hours before departure. We are not liable for delayed flights, though our local team will support finding alternative accommodations where possible.</p>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <h4>8. Check-In & Luggage</h4>
                    <p>Please check in 3 hours before international flights. Baggage allowances vary by airline and we advise checking guidelines directly on airline operator websites before traveling.</p>
                </div>
            </div>

            <!-- Card 9 -->
            <div class="col-md-6 col-lg-4">
                <div class="terms-card">
                    <div class="terms-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h4>9. Complaints Handling</h4>
                    <p>Written complaints must be sent within 21 days of the incident or 7 days post return to <strong>complaints@makkahgateway.co.uk</strong>. Delayed requests cannot be processed.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <div class="quick-alert-box shadow-sm">
                    <strong>Important Note:</strong> All bookings are ATOL Protected under Civil Aviation Authority license regulations. For any emergencies, you can contact our live support staff at <strong>0203 411 1934</strong>.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
