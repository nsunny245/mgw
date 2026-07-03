<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Makkah Gateway Alert</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333333; margin: 0; padding: 20px; }
        .card { background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto; border-top: 4px solid #198754; }
        h2 { color: #198754; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #eeeeee; }
        th { background-color: #f9f9f9; color: #555555; width: 35%; }
        .footer { text-align: center; font-size: 11px; color: #999999; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #198754; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🔔 New Alert: {{ $type }}</h2>
        <p>A new visitor action has been performed on the website. Here are the details:</p>

        <table>
            @foreach($details as $key => $value)
                @if(!empty($value))
                    <tr>
                        <th>{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                        <td>{{ $value }}</td>
                    </tr>
                @endif
            @endforeach
        </table>

        <div style="text-align: center;">
            <a href="https://makkahgateway.co.uk/admin" class="btn">Access Management Panel</a>
        </div>
    </div>
    <div class="footer">
        <p>This is an automated notification from Makkah Gateway Portal.</p>
    </div>
</body>
</html>
