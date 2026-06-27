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
