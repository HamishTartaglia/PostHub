<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Profile;

class CommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postUser;
    public $message;
    public $commentUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($commentUser,$postUser)
    {
        $postUser = Profile::findOrFail($postUser);
        $commentUser = Profile::findOrFail($commentUser);

        $this->postUser = $postUser;
        $this->commentUser = $commentUser;
        $this->message = "{$commentUser->username} posted a comment on your post";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->postUser->id);
    }
}
