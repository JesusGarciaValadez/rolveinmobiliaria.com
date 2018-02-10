<?php

namespace App\Providers;

use App\Call;
use App\Sale;
use App\Policies\CallPolicy;
use App\Policies\SalePolicy;
use App\Policies\ClientPolicy;
use App\Policies\MessagePolicy;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      App\User::class => App\Policies\AdminPolicy::class,
      App\Message::class => App\Policies\MessagePolicy::class,
      App\Client::class => App\Policies\ClientPolicy::class,
      App\Call::class => App\Policies\CallPolicy::class,
      App\Sale::class => App\Policies\SalePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      $this->registerPolicies();

      Passport::routes();

      Gate::resource('user', 'App\Policies\AdminPolicy');

      Gate::resource('messages', 'App\Policies\MessagePolicy');

      Gate::resource('clients', 'App\Policies\ClientPolicy');

      Gate::resource('calls', 'App\Policies\CallPolicy');

      Gate::resource('sales', 'App\Policies\SalePolicy');
    }
}
