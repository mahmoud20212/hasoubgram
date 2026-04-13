<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Post $post, public User $likedBy)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via()
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase()
    {
        return [
            'type' => 'like',
            'message' => $this->likedBy->username . ' liked your post',
            'username' => $this->likedBy->username,
            'user_image' => $this->likedBy->image,
            'post_link' => route('posts.show', $this->post->slug),
            'created_at' => now()->toTimeString(),
        ];
    }
}
