<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATOL Protection Certificate - {{ $customer->full_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .certificate-card { background: #fff; max-width: 800px; margin: 40px auto; padding: 50px; border-radius: 16px; box-shadow: 0 4px 30px rgba(0,0,0,0.05); border: 2px solid #005A9C; position: relative; }
        .cert-header { text-align: center; border-bottom: 2px solid #005A9C; padding-bottom: 20px; margin-bottom: 30px; }
        .cert-title { color: #005A9C; font-weight: 800; font-size: 2rem; }
        .cert-badge { background-color: #005A9C; color: #fff; padding: 5px 15px; border-radius: 20px; font-weight: bold; display: inline-block; }
        .table-cert th { width: 35%; background: #f8f9fa; font-weight: 600; }
        .legal-text { font-size: 0.8rem; line-height: 1.4; color: #6c757d; }
        @media print {
            body { background: #fff; margin: 0; }
            .certificate-card { box-shadow: none; border: 2px solid #005A9C; padding: 30px; margin: 0; max-width: 100%; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="container my-4 no-print text-center">
    <button onclick="window.print()" class="btn btn-primary px-4 py-2 fw-bold"><i class="bi bi-printer-fill me-2"></i> Print Certificate / Export PDF</button>
    <a href="/admin/customers" class="btn btn-secondary px-4 py-2 ms-2">Back to CRM</a>
</div>

<div class="certificate-card">
    <div class="cert-header">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <img src="{{ asset('frontend/images/logo.png') }}" class="invoice-logo mb-2" style="max-height: 55px;" alt="Makkah Gateway">
            <span class="cert-badge">ATOL PROTECTED</span>
        </div>
        <h1 class="cert-title">ATOL CERTIFICATE</h1>
        <p class="text-muted small">This certificate confirms that the travel arrangements listed below are protection-insured under the ATOL scheme.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <h5 class="fw-bold border-bottom pb-2" style="color: #005A9C;">Protection Details</h5>
            <table class="table table-bordered table-cert small">
                <tbody>
                    <tr>
                        <th>ATOL Certificate Number:</th>
                        <td class="fw-bold text-primary">{{ $atol->atol_certificate_number ?? 'ATOL-11941' }}</td>
                    </tr>
                    <tr>
                        <th>Date of Protection:</th>
                        <td>{{ $atol->protection_date ? $atol->protection_date->format('d M Y') : date('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Lead Passenger:</th>
                        <td>{{ $customer->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Package Description:</th>
                        <td>{{ $customer->package->title ?? 'Umrah Package Arrangement' }}</td>
                    </tr>
                    <tr>
                        <th>Dates of Travel:</th>
                        <td>
                            @if($customer->travel_date && $customer->return_date)
                                {{ $customer->travel_date->format('d M Y') }} to {{ $customer->return_date->format('d M Y') }}
                            @else
                                TBD
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="legal-text p-3 border rounded bg-light mb-4">
        <p class="mb-2"><strong>Who is protected?</strong> The passengers named on this certificate are protected. Under UK Civil Aviation regulations, this certificate provides proof of financial protection under ATOL License for the specified flight and accommodation package.</p>
        <p class="mb-0"><strong>What is protected?</strong> Your package flight and hotel accommodation details listed in your booking itinerary are covered. In the event of supplier failure, alternative arrangements or full refunds will be facilitated by the CAA.</p>
    </div>

    <div class="border-top pt-4 text-center text-muted small">
        <p class="mb-0">Makkah Gateway is a trading name of Makkah Gateway LTD. Registered office: HP14 3FE, United Kingdom.</p>
        <p class="tiny mt-1 text-primary fw-bold">ATOL License Holder #11941. Civil Aviation Authority.</p>
    </div>
</div>

</body>
</html>
