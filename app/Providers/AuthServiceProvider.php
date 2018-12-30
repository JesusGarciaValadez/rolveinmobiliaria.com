<?php

declare(strict_types=1);

namespace App\Providers;

use App\Call;
use App\Client;
use App\ClosingContract;
use App\Contract;
use App\Message;
use App\Notary;
use App\Policies\CallPolicy;
use App\Policies\ClientPolicy;
use App\Policies\ClosingContractPolicy;
use App\Policies\ContractPolicy;
use App\Policies\MessagePolicy;
use App\Policies\NotaryPolicy;
use App\Policies\SalePolicy;
use App\Policies\SellerPolicy;
use App\Policies\SignaturePolicy;
use App\Policies\VisitPolicy;
use App\Sale;
use App\Seller;
use App\Signature;
use App\Visit;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => AdminPolicy::class,
        Message::class => MessagePolicy::class,
        Client::class => ClientPolicy::class,
        Call::class => CallPolicy::class,
        Sale::class => SalePolicy::class,
        Seller::class => SellerPolicy::class,
        ClosingContract::class => ClosingContractPolicy::class,
        Visit::class => VisitPolicy::class,
        Contract::class => ContractPolicy::class,
        Notary::class => NotaryPolicy::class,
        Signature::class => SignaturePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::resource('user', 'App\Policies\AdminPolicy');

        Gate::resource('message', 'App\Policies\MessagePolicy');

        Gate::resource('client', 'App\Policies\ClientPolicy');

        Gate::resource('call', 'App\Policies\CallPolicy');

        Gate::resource('sale', 'App\Policies\SalePolicy');

        Gate::resource('seller', 'App\Policies\SellerPolicy');

        Gate::resource('closing_contract', 'App\Policies\ClosingContractPolicy');

        Gate::resource('visit', 'App\Policies\VisitPolicy');

        Gate::resource('contract', 'App\Policies\ContractPolicy');

        Gate::resource('notary', 'App\Policies\NotaryPolicy');

        Gate::resource('signature', 'App\Policies\SignaturePolicy');
    }
}
