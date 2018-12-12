<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\MessageCreatedEvent;
use App\Events\MessageDeletedEvent;
use App\Events\SaleCreatedEvent;
use App\Events\FileWillUploadEvent;
use App\Listeners\MessageCreatedListener;
use App\Listeners\MessageDeletedListener;
use App\Listeners\SaleCreatedListener;
use App\Listeners\FileUploadedListener;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    MessageCreatedEvent::class => [
      MessageCreatedListener::class,
    ],
    MessageDeletedEvent::class => [
      MessageDeletedListener::class,
    ],
    SaleCreatedEvent::class => [
      SaleCreatedListener::class,
    ],
    FileWillUploadEvent::class => [
      FileUploadedListener::class,
    ],
    Registered::class => [
      SendEmailVerificationNotification::class,
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
