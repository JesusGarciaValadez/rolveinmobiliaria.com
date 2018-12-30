<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\MessageCreatedEvent;
use App\Mail\MessageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MessageCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'redis';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     */
    public function handle(MessageCreatedEvent $event): void
    {
        Mail::to('alejandro.rojas@rolveinmobiliaria.com')
            ->cc('fernanda.ornelas@rolveinmobiliaria.com')
            ->bcc('jesus.garciav@me.com')
            ->send(new MessageCreated($event->messageCreated));
    }
}
