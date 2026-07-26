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
        // Spam protection honeypot check
        if ($request->filled('fax_number')) {
            logger('Spam inquiry blocked via honeypot from IP: ' . $request->ip());
            return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
        }

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

        // Fetch configured settings
        $settings = Setting::first();

        // 1. Broadcast real-time WebSocket event (Pusher)
        if ($settings && !empty($settings->pusher_app_key)) {
            try {
                event(new \App\Events\NewInquiryBroadcast($inquiry->toArray()));
            } catch (\Exception $e) {
                logger('Broadcasting failed: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
    }
}
