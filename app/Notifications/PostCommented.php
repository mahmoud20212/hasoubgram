<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCommented extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Post $post, public User $commenter)
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
            'type' => 'comment',
            'message' => $this->commenter->username . ' commented on your post',
            'username' => $this->commenter->username,
            'user_image' => $this->commenter->image,
            'post_link' => route('posts.show', $this->post->slug),
            'comment_body' => request('body'),
            'created_at' => now()->toTimeString(),
        ];
    }
}
