<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function all()
    {
        return Message::all();
    }

    public function find($id)
    {
        return Message::findOrFail($id);
    }

    public function create(array $data)
    {
        return Message::create($data);
    }

    public function update(Message $message, array $data)
    {
        $message->update($data);
        return $message;
    }

    public function delete(Message $message)
    {
        return $message->delete();
    }

    public function getPrivateMessages($userId, $receiverId)
    {
        return Message::with('user')
            ->where(function ($query) use ($userId, $receiverId) {
                $query->where('user_id', $userId)->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($userId, $receiverId) {
                $query->where('user_id', $receiverId)->where('receiver_id', $userId);
            })
            ->orderBy('created_at')
            ->get();
    }

    public function createMessageWithUser($userId, $receiverId, $messageContent, $imagePath = null)
    {
        $message = $this->create([
            'user_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $messageContent,
            'image_path' => $imagePath,
        ]);

        return $message->load('user');
    }

    public function getUserConversations($userId)
    {
        // Get blocked user IDs (users that this user has blocked or users that have blocked this user)
        $blockedByMe = \App\Models\BlockedUser::where('user_id', $userId)->pluck('blocked_user_id')->toArray();
        $blockedMe = \App\Models\BlockedUser::where('blocked_user_id', $userId)->pluck('user_id')->toArray();
        $blockedUserIds = array_unique(array_merge($blockedByMe, $blockedMe));

        // Get all unique conversation partners for the user
        $conversations = Message::select('user_id', 'receiver_id', 'message', 'created_at')
            ->with(['user:id,fname,lname', 'receiver:id,fname,lname'])
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) use ($userId) {
                // Group by the other user in the conversation
                return $message->user_id == $userId ? $message->receiver_id : $message->user_id;
            })
            ->map(function ($messages) use ($userId) {
                $latestMessage = $messages->first();
                $otherUser = $latestMessage->user_id == $userId ? $latestMessage->receiver : $latestMessage->user;
                
                return [
                    'user' => $otherUser,
                    'latest_message' => $latestMessage,
                    'unread_count' => $messages->where('receiver_id', $userId)->where('is_read', false)->count(),
                ];
            })
            ->filter(function ($conversation) use ($blockedUserIds) {
                // Filter out conversations with blocked users
                return !in_array($conversation['user']->id, $blockedUserIds);
            })
            ->values();

        return $conversations;
    }
} 