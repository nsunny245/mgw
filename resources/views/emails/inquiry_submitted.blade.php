<!DOCTYPE html>
<html>
<head>
    <title>New Lead Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #0b4f36;">New Lead Inquiry Received</h2>
    <p>A new inquiry has been submitted through the Makkah Gateway website. Here are the details:</p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold; width: 180px;">Full Name:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Phone Number:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->phone }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Email Address:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->email }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Departure City:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->city ?: 'N/A' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Number of Persons:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->persons ?: 'N/A' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Travel Date:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->travel_date ?: 'N/A' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Package / Subject:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->package_type ?: 'General Inquiry' }}</td>
        </tr>
        @if($inquiry->message)
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Message:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $inquiry->message }}</td>
        </tr>
        @endif
    </table>
    <p style="margin-top: 25px; font-size: 12px; color: #777;">This is an automated notification from Makkah Gateway website.</p>
</body>
</html>
