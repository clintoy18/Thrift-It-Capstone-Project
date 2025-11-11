<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PrivateMessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $sender; // simplified sender info
    protected $receiverId;

        public function __construct(Message $message, $receiver)
        {
            $this->message = $message;
            $this->sender = [
                'id' => $message->user->id,
                'fname' => $message->user->fname,
                'lname' => $message->user->lname,
                'profile_pic' => $message->user->profile_pic
                ? Storage::disk('s3')->url($message->user->profile_pic)
                : asset('images/default-profile.jpg'),
            ];
            $this->receiverId = $receiver->id;
        }


    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->receiverId);
    }

    public function broadcastAs()
    {
        return 'private-message';
    }
}
