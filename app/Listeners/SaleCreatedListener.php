<?php

namespace App\Listeners;

use App\Events\SaleCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Mail\SaleCreated;

class SaleCreatedListener implements ShouldQueue
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
   * @param  SaleCreatedEvent  $event
   * @return void
   */
  public function handle(SaleCreatedEvent $event)
  {
    Mail::to('alejandro.rojas@rolveinmobiliaria.com')
      ->cc('fernanda.ornelas@rolveinmobiliaria.com')
      ->bcc('jesus.garciav@me.com')
      ->send(new SaleCreated($event->_sale));
  }
}
