<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Setting;
use App\Mail\InquirySubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'persons' => ['nullable', 'string', 'max:50'],
            'travel_date' => ['nullable', 'date'],
            'package_type' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        $supportStaff = \App\Models\User::where('role', 'Support Staff')->first();
        if ($supportStaff) {
            $data['assigned_to'] = $supportStaff->id;
        }

        $inquiry = Inquiry::create($data);

        // Fetch configured settings email, fallback to default info@makkahgateway.co.uk if not set
        $notificationEmail = Setting::first()->email ?? 'info@makkahgateway.co.uk';

        try {
            Mail::to($notificationEmail)->send(new InquirySubmitted($inquiry));
        } catch (\Exception $e) {
            // Log or ignore during local development
            logger('Email notification failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Inquiry submitted successfully.');
    }
}
