<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailVerifiedBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;

    /**
     * Create a new event instance.
     * We accept the verified User object to get their ID.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->message = 'Email verification complete.';
    }

    /**
     * Get the channels the event should broadcast on.
     * * The private channel is named 'user.{user_id}'. Only the user whose ID 
     * is in the channel name will be authorized to listen to it.
     */
    public function broadcastOn(): array
    {
        // This broadcasts the event to the unique channel for this user.
        return [
            new PrivateChannel('user.' . $this->user->id),
        ];
    }

    /**
     * The event's broadcast name.
     * This is the name the JavaScript listener will watch for.
     */
    public function broadcastAs()
    {
        // The client listener will use: .listen('.EmailVerified', ...)
        return 'EmailVerified';
    }

    /**
     * Get the data to broadcast.
     * This is optional, but ensures the listener receives something useful.
     */
    public function broadcastWith(): array
    {
        return [
            'userId' => $this->user->id,
            'status' => $this->message,
        ];
    }
}
