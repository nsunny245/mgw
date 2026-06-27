<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice & Voucher - {{ $customer->full_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .invoice-card { background: #fff; max-width: 900px; margin: 40px auto; padding: 50px; border-radius: 16px; box-shadow: 0 4px 30px rgba(0,0,0,0.05); border: 1px solid #e9ecef; }
        .invoice-logo { max-height: 55px; }
        .bill-header { border-bottom: 2px solid #f1f3f5; padding-bottom: 20px; margin-bottom: 30px; }
        .table-totals th { background: #f8f9fa; }
        @media print {
            body { background: #fff; margin: 0; }
            .invoice-card { box-shadow: none; border: none; padding: 0; margin: 0; max-width: 100%; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="container my-4 no-print text-center">
    <button onclick="window.print()" class="btn btn-success px-4 py-2 fw-bold"><i class="bi bi-printer-fill me-2"></i> Print Document / Export PDF</button>
    <a href="/ben-orbit-portal-7842/customers" class="btn btn-secondary px-4 py-2 ms-2">Back to CRM</a>
</div>

<div class="invoice-card">
    <div class="bill-header">
        <div class="row align-items-center">
            <div class="col-6">
                <img src="{{ asset('frontend/images/logo.png') }}" class="invoice-logo mb-2" alt="Makkah Gateway">
                <p class="text-muted small mb-0">High Quality Umrah & Hajj Services<br>HP14 3FE, United Kingdom</p>
            </div>
            <div class="col-6 text-end">
                <h3 class="fw-bold text-success mb-1">INVOICE & ITINERARY</h3>
                <p class="text-muted small mb-0">Date Issued: {{ date('d M Y') }}<br>Customer Reference: #CUST-{{ $customer->id }}</p>
            </div>
        </div>
    </div>

    <!-- Personal & Travel Details -->
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <h5 class="fw-bold text-success border-bottom pb-2">Passenger Information</h5>
            <div class="small">
                <strong>Name:</strong> {{ $customer->full_name }}<br>
                <strong>Email:</strong> {{ $customer->email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $customer->mobile ?? 'N/A' }}<br>
                <strong>Passport:</strong> {{ $customer->passport_number ?? 'N/A' }}<br>
                <strong>Nationality:</strong> {{ $customer->nationality ?? 'N/A' }}
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h5 class="fw-bold text-success border-bottom pb-2">Travel Itinerary</h5>
            <div class="small">
                <strong>Package:</strong> {{ $customer->package->title ?? 'Custom Umrah Package' }}<br>
                <strong>Departure:</strong> {{ $customer->departure_city ?? 'UK Airport' }}<br>
                <strong>Travel Dates:</strong> 
                @if($customer->travel_date && $customer->return_date)
                    {{ $customer->travel_date->format('d M Y') }} to {{ $customer->return_date->format('d M Y') }}
                @else
                    TBD
                @endif
                <br>
                <strong>Status:</strong> <span class="badge bg-success">{{ $customer->status }}</span>
            </div>
        </div>
    </div>

    <!-- Hotel stays -->
    @if($customer->hotelBookings->isNotEmpty())
        <div class="mb-5">
            <h5 class="fw-bold text-success border-bottom pb-2">Hotel Accommodations</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Hotel Name</th>
                            <th>City</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Rooms</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->hotelBookings as $hotel)
                            <tr>
                                <td>{{ $hotel->hotel_name }}</td>
                                <td>{{ $hotel->city ?? 'N/A' }}</td>
                                <td>{{ $hotel->check_in ? $hotel->check_in->format('d M Y') : 'N/A' }}</td>
                                <td>{{ $hotel->check_out ? $hotel->check_out->format('d M Y') : 'N/A' }}</td>
                                <td>{{ $hotel->number_rooms }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Flights details -->
    @if($customer->flightBookings->isNotEmpty())
        <div class="mb-5">
            <h5 class="fw-bold text-success border-bottom pb-2">Flight Reservations</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Airline</th>
                            <th>Reference</th>
                            <th>Departure</th>
                            <th>Return</th>
                            <th>Ticket Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->flightBookings as $flight)
                            <tr>
                                <td>{{ $flight->airline }}</td>
                                <td><code>{{ $flight->booking_reference }}</code></td>
                                <td>{{ $flight->departure_date ? $flight->departure_date->format('d M Y') : 'N/A' }}</td>
                                <td>{{ $flight->return_date ? $flight->return_date->format('d M Y') : 'N/A' }}</td>
                                <td>{{ $flight->ticket_number ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Payment Ledger -->
    <div class="mb-5">
        <h5 class="fw-bold text-success border-bottom pb-2">Payment Ledger</h5>
        <div class="table-responsive">
            <table class="table table-striped align-middle small">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Method</th>
                        <th>Notes</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_date ? $payment->payment_date->format('d M Y') : 'N/A' }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->notes ?? 'Payment received' }}</td>
                            <td class="text-end fw-semibold">£{{ number_format($payment->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No payments recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pricing Summary -->
    <div class="row justify-content-end">
        <div class="col-md-5">
            <table class="table table-bordered table-totals small">
                <tbody>
                    <tr>
                        <th class="w-50">Package Value:</th>
                        <td class="text-end fw-semibold">£{{ number_format($customer->package_value, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Deposit Paid:</th>
                        <td class="text-end text-success fw-semibold">£{{ number_format($customer->payments()->sum('amount'), 2) }}</td>
                    </tr>
                    <tr class="table-danger">
                        <th class="fw-bold">Outstanding Balance:</th>
                        <td class="text-end fw-bold text-danger">£{{ number_format($customer->remaining_balance, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="border-top pt-4 mt-5 text-center text-muted small">
        <p>Thank you for choosing Makkah Gateway for your sacred journey. For support, email info@makkahgateway.co.uk.</p>
        <p class="tiny">ATOL Protected & Approved Uk Travel Operator.</p>
    </div>
</div>

</body>
</html>
