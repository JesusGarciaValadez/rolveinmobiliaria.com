<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Events\MessageCreatedEvent;
use App\Mail\MessageCreated;

class MessageCreatedListener
{
  use InteractsWithQueue;

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle(MessageCreatedEvent $event)
  {
    Mail::to('alejandro.rojas@rolveinmobiliaria.com')
      ->cc('fernanda.ornelas@rolveinmobiliaria.com')
      ->bcc('jesus.garciav@me.com')
      ->send(new MessageCreated($event->messageCreated));
  }
}
