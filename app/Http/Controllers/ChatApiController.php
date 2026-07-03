<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatApiController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        // Automatically assign to first Support Staff user if available
        $supportStaff = User::where('role', 'Support Staff')->first();

        $session = ChatSession::create([
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
            'assigned_to' => $supportStaff?->id,
            'status' => 'open',
        ]);

        // Create initial greeting message
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender' => 'staff',
            'message' => "Hello {$request->name}! How can we help you today with your Hajj or Umrah inquiries?",
        ]);

        $settings = \App\Models\Setting::first();

        // 1. Broadcast real-time WebSocket event for new chat
        if ($settings && !empty($settings->pusher_app_key)) {
            try {
                event(new \App\Events\NewChatBroadcast([
                    'name' => $session->visitor_name,
                    'message' => 'Started a new support chat conversation',
                    'session_id' => $session->id,
                ]));
            } catch (\Exception $e) {
                logger('Broadcasting chat failed: ' . $e->getMessage());
            }
        }

        // 2. Save to database notifications for Filament bell & toasts
        try {
            $users = User::all();
            \Filament\Notifications\Notification::make()
                ->title('New Live Chat Started')
                ->body("Visitor {$session->visitor_name} started a live chat.")
                ->icon('heroicon-o-chat-bubble-left-right')
                ->iconColor('info')
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
                \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\AdminNotificationMail('New Live Chat Started', [
                    'visitor_name' => $session->visitor_name,
                    'visitor_email' => $session->visitor_email ?? 'Not provided',
                    'assigned_staff' => $supportStaff?->name ?? 'Support Queue',
                    'action' => 'Visit your admin panel to reply to this conversation.',
                ]));
            } catch (\Exception $e) {
                logger('Chat email notification failed for ' . $email . ': ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'session_id' => $session->id,
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'chat_session_id' => 'required|exists:chat_sessions,id',
            'message' => 'required|string',
        ]);

        $message = ChatMessage::create([
            'chat_session_id' => $request->chat_session_id,
            'sender' => 'visitor',
            'message' => $request->message,
        ]);

        $settings = \App\Models\Setting::first();
        if ($settings && !empty($settings->pusher_app_key)) {
            try {
                $session = ChatSession::find($request->chat_session_id);
                event(new \App\Events\NewChatBroadcast([
                    'name' => $session->visitor_name,
                    'message' => $message->message,
                    'session_id' => $session->id,
                ]));
            } catch (\Exception $e) {
                logger('Broadcasting chat message failed: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function getMessages($id)
    {
        $session = ChatSession::findOrFail($id);
        $messages = $session->messages()->orderBy('created_at', 'asc')->get();

        return response()->json([
            'success' => true,
            'status' => $session->status,
            'messages' => $messages,
        ]);
    }
}
