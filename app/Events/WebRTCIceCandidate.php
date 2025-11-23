<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebRTCIceCandidate implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $recipientId;
    public $candidate;
    public $callerId;

    public function __construct($recipientId, $candidate, $callerId)
    {
        $this->recipientId = $recipientId;
        $this->candidate = $candidate;
        $this->callerId = $callerId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->recipientId);
    }

    public function broadcastAs()
    {
        return 'webrtc.ice-candidate';
    }

    public function broadcastWith()
    {
        return [
            'candidate' => $this->candidate,
            'callerId' => $this->callerId
        ];
    }
}

