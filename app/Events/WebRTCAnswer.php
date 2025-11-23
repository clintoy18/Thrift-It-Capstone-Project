<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebRTCAnswer implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $recipientId;
    public $answer;
    public $callerId;

    public function __construct($recipientId, $answer, $callerId)
    {
        $this->recipientId = $recipientId;
        $this->answer = $answer;
        $this->callerId = $callerId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->recipientId);
    }

    public function broadcastAs()
    {
        return 'webrtc.answer';
    }

    public function broadcastWith()
    {
        return [
            'answer' => $this->answer,
            'callerId' => $this->callerId,
            'type' => 'video'
        ];
    }
}

