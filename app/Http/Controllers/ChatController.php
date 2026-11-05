<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        
        // Find all chats where the user is a participant
        $chats = Chat::where('participants', 'all', [$userId])
            ->orderBy('last_message_at', 'desc')
            ->get();

        $activeChat = null;
        $otherUser = null;

        // If a specific chat is selected
        if ($request->has('chat_id')) {
            $activeChat = Chat::findOrFail($request->chat_id);
            if (!in_array($userId, $activeChat->participants)) {
                abort(403);
            }
            $otherUser = $activeChat->otherParticipant($userId);
        } 
        // Or if we want to start a chat with a specific user
        elseif ($request->has('user_id')) {
            $otherUserId = $request->user_id;
            if ($otherUserId === $userId) {
                return redirect()->route('chats.index')->with('error', 'You cannot chat with yourself.');
            }
            
            $otherUser = User::findOrFail($otherUserId);

            // Find existing chat between these two
            $activeChat = Chat::where('participants', 'all', [$userId, $otherUserId])->first();

            // If none exists, create a new one
            if (!$activeChat) {
                $activeChat = Chat::create([
                    'participants' => [$userId, $otherUserId],
                    'messages' => [],
                    'last_message_at' => Carbon::now(),
                ]);
            }
        } 
        // Fallback to first chat in list
        elseif ($chats->isNotEmpty()) {
            $activeChat = $chats->first();
            $otherUser = $activeChat->otherParticipant($userId);
        }

        return view('chat.index', compact('chats', 'activeChat', 'otherUser'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|string',
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::findOrFail($request->chat_id);
        $userId = auth()->id();

        if (!in_array($userId, $chat->participants)) {
            abort(403);
        }

        $newMessage = [
            'sender_id' => $userId,
            'message' => $request->message,
            'created_at' => Carbon::now()->toIso8601String(),
        ];

        // Append to messages array
        $chat->push('messages', $newMessage);
        $chat->last_message_at = Carbon::now();
        $chat->save();

        // Notify the recipient
        $recipientId = collect($chat->participants)->first(fn($id) => $id !== $userId);
        Notification::create([
            'user_id' => $recipientId,
            'type' => 'chat',
            'title' => 'New Message from ' . auth()->user()->name,
            'message' => Str::limit($request->message, 50),
            'is_read' => false,
            'data' => ['chat_id' => $chat->id]
        ]);

        return redirect()->route('chats.index', ['chat_id' => $chat->id]);
    }
}
