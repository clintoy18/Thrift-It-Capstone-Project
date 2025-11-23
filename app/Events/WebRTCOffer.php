<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebRTCOffer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $recipientId;
    public $offer;
    public $callerId;

    public function __construct($recipientId, $offer, $callerId)
    {
        $this->recipientId = $recipientId;
        $this->offer = $offer;
        $this->callerId = $callerId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->recipientId);
    }

    public function broadcastAs()
    {
        return 'webrtc.offer';
    }

    public function broadcastWith()
    {
        return [
            'offer' => $this->offer,
            'callerId' => $this->callerId,
            'type' => 'video'
        ];
    }
}

