<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of messages between authenticated user and another user.
     */
    public function index(Request $request, $userId = null)
    {
        $authUserId = Auth::id();

        if ($userId) {
            // Get conversation between two users
            $messages = Message::where(function($query) use ($authUserId, $userId) {
                $query->where('sender_id', $authUserId)
                      ->where('receiver_id', $userId);
            })->orWhere(function($query) use ($authUserId, $userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $authUserId);
            })
            ->with(['sender:id,name', 'receiver:id,name'])
            ->orderBy('sent_at', 'asc')
            ->get();

            return response()->json([
                'success' => true,
                'data' => $messages
            ]);
        }

        // Get all conversations for the authenticated user
        $conversations = Message::where('sender_id', $authUserId)
            ->orWhere('receiver_id', $authUserId)
            ->with(['sender:id,name', 'receiver:id,name'])
            ->orderBy('sent_at', 'desc')
            ->get()
            ->groupBy(function($message) use ($authUserId) {
                return $message->sender_id == $authUserId ? $message->receiver_id : $message->sender_id;
            })
            ->map(function($messages) {
                return $messages->first();
            });

        return response()->json([
            'success' => true,
            'data' => $conversations->values()
        ]);
    }

    /**
     * Store a newly created message.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $authUserId = Auth::id();

        // Check if user is trying to send message to themselves
        if ($authUserId == $request->receiver_id) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot send message to yourself'
            ], 400);
        }

        $message = Message::create([
            'sender_id' => $authUserId,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'sent_at' => now(),
        ]);

        $message->load(['sender:id,name', 'receiver:id,name']);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        $authUserId = Auth::id();

        // Check if user is authorized to view this message
        if ($message->sender_id !== $authUserId && $message->receiver_id !== $authUserId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to view this message'
            ], 403);
        }

        $message->load(['sender:id,name', 'receiver:id,name']);

        return response()->json([
            'success' => true,
            'data' => $message
        ]);
    }

    /**
     * Update the specified message.
     */
    public function update(Request $request, Message $message)
    {
        $authUserId = Auth::id();

        // Only sender can update their message
        if ($message->sender_id !== $authUserId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to update this message'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $message->update([
            'message' => $request->message,
        ]);

        $message->load(['sender:id,name', 'receiver:id,name']);

        return response()->json([
            'success' => true,
            'message' => 'Message updated successfully',
            'data' => $message
        ]);
    }

    /**
     * Remove the specified message.
     */
    public function destroy(Message $message)
    {
        $authUserId = Auth::id();

        // Only sender can delete their message
        if ($message->sender_id !== $authUserId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete this message'
            ], 403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully'
        ]);
    }

    /**
     * Get list of users to start a conversation with.
     */
    public function getUsers(Request $request)
    {
        $authUserId = Auth::id();
        $search = $request->get('search');

        $users = User::where('id', '!=', $authUserId)
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->select('id', 'name', 'email')
            ->limit(20)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Mark messages as read (if you want to implement read status).
     */
    public function markAsRead(Request $request, $userId)
    {
        $authUserId = Auth::id();

        Message::where('sender_id', $userId)
            ->where('receiver_id', $authUserId)
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Messages marked as read'
        ]);
    }

    /**
     * Get unread message count.
     */
    public function getUnreadCount()
    {
        $authUserId = Auth::id();

        $count = Message::where('receiver_id', $authUserId)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,
            'unread_count' => $count
        ]);
    }
}
