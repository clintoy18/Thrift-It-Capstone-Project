<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ProductCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;
    protected $product;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment, Product $product)
    {
        $this->comment = $comment;
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'product_id' => $this->product->id,
            'product_title' => $this->product->title,
            'commenter_name' => $this->comment->user->name,
            'commenter_id' => $this->comment->user_id,
            'comment_preview' => substr($this->comment->content, 0, 100),
            'created_at' => $this->comment->created_at,
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'type' => 'App\\Notifications\\ProductCommentNotification',
            'data' => $this->toArray($notifiable),
            'read_at' => null,
        ]);
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }
}
