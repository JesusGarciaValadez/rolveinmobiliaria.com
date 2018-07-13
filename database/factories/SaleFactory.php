<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  $internal_expedients_id = factory(App\InternalExpedient::class)->create()->id;

  $sellers_id = factory(App\Seller::class)->create()->id;

  $closing_contracts_id = factory(App\ClosingContract::class)->create()->id;

  $contracts_id = factory(App\Contract::class)->create()->id;

  $notaries_id = factory(App\Notary::class)->create()->id;

  $signatures_id = factory(App\Signature::class)->create()->id;

  $user_id = factory(App\User::class)->create()->id;

  return [
    'internal_expedients_id' => $internal_expedients_id,
    'sellers_id' => $sellers_id,
    'closing_contracts_id' => $closing_contracts_id,
    'contracts_id' => $contracts_id,
    'notaries_id' => $notaries_id,
    'signatures_id' => $signatures_id,
    'user_id' => $user_id,
  ];
});
