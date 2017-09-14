<?php

namespace App\Providers;

use App\Call;
use App\Sale;
use App\Policies\CallPolicy;
use App\Policies\SalePolicy;

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
      'App\Model' => 'App\Policies\ModelPolicy',
      App\Call::class => App\Policies\CallPolicy::class,
      App\Sale::class => App\Policies\SalePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      $this->registerPolicies();

      Gate::resource('calls', 'App\Policies\CallPolicy', [
        'menu' => 'viewMenu',
        'delete' => 'viewDeleteButton',
      ]);
      Gate::resource('sales', 'App\Policies\SalePolicy', [
        'menu' => 'viewMenu'
      ]);
    }
}
