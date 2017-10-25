<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  $internal_expedients_id = $faker->randomElement([
    factory(App\InternalExpedient::class)->create()->id,
    null,
  ]);

  $sale_documents_id = (empty($internal_expedients_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleDocument::class)->create()->id,
        null,
      ]);

  $sale_closing_contracts_id = (empty($sale_documents_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleClosingContract::class)->create()->id,
        null,
      ]);

  $sale_logs_id = (empty($sale_closing_contracts_id))
    ? null
    : $faker->randomElement([
        factory(App\SaleLog::class)->create()->id,
        null,
      ]);

  $sale_contracts_id = (empty($sale_logs_id))
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

  return [
    'internal_expedients_id' => $internal_expedients_id,
    'sale_documents_id' => $sale_documents_id,
    'sale_closing_contracts_id' => $sale_closing_contracts_id,
    'sale_logs_id' => $sale_logs_id,
    'sale_contracts_id' => $sale_contracts_id,
    'sale_notaries_id' => $sale_notaries_id,
    'sale_signatures_id' => $sale_signatures_id,
  ];
});
