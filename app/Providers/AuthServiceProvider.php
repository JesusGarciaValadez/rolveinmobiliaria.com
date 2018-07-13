<?php

namespace App\Providers;

use App\Message as Message;
use App\Client as Client;
use App\Call as Call;
use App\Sale as Sale;
use App\Seller as Seller;
use App\ClosingContract as ClosingContract;
use App\Visit as Visit;
use App\Contract as Contract;
use App\Notary as Notary;
use App\Signature as Signature;
use App\Policies\MessagePolicy as MessagePolicy;
use App\Policies\ClientPolicy as ClientPolicy;
use App\Policies\CallPolicy as CallPolicy;
use App\Policies\SalePolicy as SalePolicy;
use App\Policies\SellerPolicy as SellerPolicy;
use App\Policies\ClosingContractPolicy as ClosingContractPolicy;
use App\Policies\ContractPolicy as ContractPolicy;
use App\Policies\VisitPolicy as VisitPolicy;
use App\Policies\NotaryPolicy as NotaryPolicy;
use App\Policies\SignaturePolicy as SignaturePolicy;

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

      Gate::resource('sellers', 'App\Policies\SellerPolicy');

      Gate::resource('closing_contracts', 'App\Policies\ClosingContractPolicy');

      Gate::resource('visits', 'App\Policies\VisitPolicy');

      Gate::resource('contracts', 'App\Policies\ContractPolicy');

      Gate::resource('notaries', 'App\Policies\NotaryPolicy');

      Gate::resource('signatures', 'App\Policies\SignaturePolicy');
    }
}
