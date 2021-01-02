<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Comment;
use App\Post;

class CommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $poster;
    public $message;
    public $commentUser;
    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment,Post $post)
    {
        $post = $post;
        $comment = $comment;
        $commentUser = $comment->profile;
        $poster = $post->profile;

        $this->post = $post;
        $this->poster = $poster;
        $this->comment = $comment;
        $this->commentUser = $commentUser;
        $this->message = "{$commentUser->username} commented on your post";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return 'user.'.$this->poster->id;
    }
}
