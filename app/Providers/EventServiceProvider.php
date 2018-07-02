<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    'App\Events\MessageCreatedEvent' => [
      'App\Listeners\MessageCreatedListener',
    ],
    'App\Events\MessageDeletedEvent' => [
      'App\Listeners\MessageDeletedListener',
    ],
    'App\Events\SaleCreatedEvent' => [
      'App\Listeners\SaleCreatedListener',
    ],
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    //
  }
}
