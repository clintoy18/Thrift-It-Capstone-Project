<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class CallInvitation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callerId;
    public $recipientId;
    public $callType;
    public $caller;
    public $action;

    public function __construct($callerId, $recipientId, $callType, $caller, $action = 'invite')
    {
        $this->callerId = $callerId;
        $this->recipientId = $recipientId;
        $this->callType = $callType;
        $this->action = $action;
        
        // Don't serialize the entire user object - just what we need
        $this->caller = [
            'id' => $caller->id,
            'fname' => $caller->fname,
            'lname' => $caller->lname,
            'name' => $caller->fname . ' ' . $caller->lname,
            'avatar' => $caller->profile_pic ? $caller->profileImageUrl() : null
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->recipientId);
    }

    public function broadcastAs()
    {
        return 'call-invitation';
    }

    public function broadcastWith()
    {
        return [
            'caller_id' => $this->callerId,
            'caller' => $this->caller,
            'call_type' => $this->callType,
            'action' => $this->action
        ];
    }
}

