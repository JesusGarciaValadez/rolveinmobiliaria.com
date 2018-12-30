<?php

declare(strict_types=1);

namespace App\Events;

use App\Sale;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaleCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $_sale;

    /**
     * Create a new event instance.
     */
    public function __construct(Sale $sale)
    {
        $this->_sale = $sale;
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
