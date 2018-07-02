<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageDeletedListener implements ShouldQueue
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
   * @param  object  $event
   * @return void
   */
  public function handle($event)
  {
    //
  }
}
