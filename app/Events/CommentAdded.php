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
    public $category;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment,Post $post)
    { 
        $commentUser = $comment->profile->username;
        $category = $post->category->name;

        $this->poster = $post->profile;
        $this->commentUser = $commentUser;
        $this->post = $post->id;
        $this->category = $category;
        $this->message = "{$commentUser} commented on your post";
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
