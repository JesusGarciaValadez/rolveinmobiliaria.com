<?php

declare(strict_types=1);

namespace App\Events;

use App\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageCreated;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $this->messageCreated = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
