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
            'form_id' => ['nullable', 'string', 'max:255'],
            'form_source' => ['nullable', 'string', 'max:255'],
            'form_url' => ['nullable', 'string'],
        ]);

        $data['form_url'] = $request->input('form_url') ?? url()->previous();

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

        // 2. Dispatch multi-email notifications (exactly one clean email per address to avoid duplicates)
        $emails = collect([$settings->email ?? 'info@makkahgateway.co.uk']);
        if ($settings && !empty($settings->notification_emails)) {
            $additionalEmails = array_filter(array_map('trim', explode(',', $settings->notification_emails)));
            $emails = $emails->merge($additionalEmails)->unique();
        }

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new \App\Mail\AdminNotificationMail('New Inquiry Submitted', [
                    'name' => $inquiry->name,
                    'phone' => $inquiry->phone,
                    'email' => $inquiry->email,
                    'departure_city' => $inquiry->city ?? 'UK',
                    'persons' => $inquiry->persons ?? '1',
                    'travel_date' => $inquiry->travel_date,
                    'message' => $inquiry->message,
                    'form_source' => $inquiry->form_source ?? 'General Inquiry Form',
                    'form_url' => $inquiry->form_url ?? url()->previous(),
                    'form_id' => $inquiry->form_id ?? 'N/A',
                ]));
            } catch (\Exception $e) {
                logger('Email notification failed for ' . $email . ': ' . $e->getMessage());
            }
        }

        if ($request->input('form_source') === 'hero_booking_form') {
            return redirect()->back()->with('success_hero', 'Your request has been received. Our team will contact you shortly.');
        }

        return redirect()->route('thankyou');
    }
}
