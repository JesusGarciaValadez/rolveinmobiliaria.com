<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      Blade::if('env', function($env)
      {
        return app()->environment($env);
      });

      Blade::component('shared.components.hamburguer-button', 'hamburguer');
      Blade::component('shared.components.branding-image', 'branding');
      Blade::component('shared.components.navbar-header', 'navbarHeader');
      Blade::component('shared.components.navbar-collapse', 'navbarCollapse');
      Blade::component('shared.components.navbar', 'navbar');
      Blade::component('shared.components.lateral-menu', 'lateralMenu');
      Blade::component('shared.components.panel-heading', 'panelHeading');
      Blade::component('shared.components.alert', 'alert');
      Blade::component('shared.components.blank-slate', 'blankSlate');

      Blade::component('messages.components.filter', 'messagesFilter');
      Blade::component('messages.components.buttons.back', 'messagesButtonBack');
      Blade::component('messages.components.buttons.create', 'messagesButtonCreate');
      Blade::component('messages.components.buttons.delete-complete', 'messagesButtonDeleteComplete');
      Blade::component('messages.components.buttons.delete', 'messagesButtonDelete');
      Blade::component('messages.components.buttons.edit-complete', 'messagesButtonEditComplete');
      Blade::component('messages.components.buttons.edit', 'messagesButtonEdit');
      Blade::component('messages.components.buttons.save', 'messagesButtonSave');

      Blade::component('clients.components.buttons.back', 'clientsButtonBack');
      Blade::component('clients.components.buttons.create', 'clientsButtonCreate');
      Blade::component('clients.components.buttons.delete', 'clientsButtonDelete');
      Blade::component('clients.components.buttons.edit', 'clientsButtonEdit');
      Blade::component('clients.components.buttons.save', 'clientsButtonSave');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
