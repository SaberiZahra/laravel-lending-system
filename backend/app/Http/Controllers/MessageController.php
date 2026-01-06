<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth; //if you want to use auth()->user() instead of  $request->user()

class MessageController extends Controller
{
    public function conversations(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $conversations = Conversation::with([
                'participants:id,full_name,username,profile_image',
                'messages' => function ($q) {
                    $q->latest()->limit(1);
                }
            ])->get();
        } else {
            $conversations = Conversation::whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with([
                'participants:id,full_name,username,profile_image',
                'messages' => function ($q) {
                    $q->latest()->limit(1);
                }
            ])->get();
        }

        return response()->json($conversations);
    }

    public function messages(Conversation $conversation, Request $request)
    {
        $user = $request->user();

        if (
            !$user->isAdmin() &&
            !$conversation->participants()->where('user_id', $user->id)->exists()
        ) {
            return response()->json(['message' => 'Not allowed'], 403);
        }

        $messages = $conversation->messages()
            ->with('sender:id,full_name,username,profile_image')
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message_text' => 'required|string',
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);
        $user = $request->user();

        if (
            !$user->isAdmin() &&
            !$conversation->participants()->where('user_id', $user->id)->exists()
        ) {
            return response()->json(['message' => 'Not allowed'], 403);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message_text' => $request->message_text,
        ]);

        return response()->json($message->load('sender'), 201);
    }

    /**
     * Get or create conversation with admin (for support chat)
     */
    public function getOrCreateAdminConversation()
    {
        $user = auth()->user();

        // Find the first admin (role = 1)
        $admin = \App\Models\User::where('role', 1)->first();

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        // Look for existing conversation between current user and admin
        $conversation = \App\Models\Conversation::whereHas('participants', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->whereHas('participants', function ($q) use ($admin) {
                $q->where('user_id', $admin->id);
            })
            ->first();

        // If not exists → create new one
        if (!$conversation) {
            $conversation = \App\Models\Conversation::create();
            $conversation->participants()->attach([$user->id, $admin->id]);
        }

        return response()->json([
            'id' => $conversation->id
        ]);
    }
}
