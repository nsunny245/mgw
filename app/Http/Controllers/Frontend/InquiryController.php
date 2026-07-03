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

        // Fetch configured settings
        $settings = Setting::first();

        // 1. Broadcast real-time WebSocket event
        if ($settings && !empty($settings->pusher_app_key)) {
            try {
                event(new \App\Events\NewInquiryBroadcast($inquiry->toArray()));
            } catch (\Exception $e) {
                logger('Broadcasting failed: ' . $e->getMessage());
            }
        }

        // 2. Save to database notifications for Filament bell & toasts
        try {
            $users = \App\Models\User::all();
            \Filament\Notifications\Notification::make()
                ->title('New Inquiry Submitted')
                ->body("Lead from {$inquiry->name} (" . ($inquiry->city ?? 'UK') . ")")
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->sendToDatabase($users);
        } catch (\Exception $e) {
            logger('Database notification failed: ' . $e->getMessage());
        }

        // 2. Dispatch multi-email notifications
        $emails = collect([$settings->email ?? 'info@makkahgateway.co.uk']);
        if ($settings && !empty($settings->notification_emails)) {
            $additionalEmails = array_filter(array_map('trim', explode(',', $settings->notification_emails)));
            $emails = $emails->merge($additionalEmails)->unique();
        }

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new InquirySubmitted($inquiry));
                Mail::to($email)->send(new \App\Mail\AdminNotificationMail('New Inquiry Submitted', [
                    'name' => $inquiry->name,
                    'phone' => $inquiry->phone,
                    'email' => $inquiry->email,
                    'departure_city' => $inquiry->city ?? 'UK',
                    'persons' => $inquiry->persons ?? '1',
                    'travel_date' => $inquiry->travel_date,
                    'message' => $inquiry->message,
                ]));
            } catch (\Exception $e) {
                logger('Email notification failed for ' . $email . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Inquiry submitted successfully.');
    }
}
