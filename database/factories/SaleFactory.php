<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  $internal_expedients_id = factory(App\InternalExpedient::class)->create()->id;

  $sale_sellers_id = factory(App\SaleSeller::class)->create()->id;

  $sale_closing_contracts_id = (empty($sale_documents_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleClosingContract::class)->create()->id,
        null,
      ]);

  $sale_contracts_id = (empty($sale_closing_contracts_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleContract::class)->create()->id,
        null,
      ]);

  $sale_notaries_id = (empty($sale_contracts_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleNotary::class)->create()->id,
        null,
      ]);

  $sale_signatures_id = (empty($sale_notaries_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleSignature::class)->create()->id,
        null,
      ]);

  $user_id = factory(App\User::class)->create()->id;

  return [
    'internal_expedients_id' => $internal_expedients_id,
    'sale_sellers_id' => $sale_sellers_id,
    'sale_closing_contracts_id' => $sale_closing_contracts_id,
    'sale_contracts_id' => $sale_contracts_id,
    'sale_notaries_id' => $sale_notaries_id,
    'sale_signatures_id' => $sale_signatures_id,
    'user_id' => $user_id,
  ];
});
