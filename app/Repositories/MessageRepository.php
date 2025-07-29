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

    public function createMessageWithUser($userId, $receiverId, $messageContent)
    {
        $message = $this->create([
            'user_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $messageContent,
        ]);

        return $message->load('user');
    }
} 