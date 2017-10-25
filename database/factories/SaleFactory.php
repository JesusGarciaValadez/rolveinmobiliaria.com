<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  return [
    'internal_expedients_id' => function () {
      return factory(App\InternalExpedient::class)->create()->id;
    },
    'sale_documents_id' => function () {
      return factory(App\SaleDocument::class)->create()->id;
    },
    'sale_closing_contracts_id' => function () {
      return factory(App\SaleClosingContract::class)->create()->id;
    },
    'sale_logs_id' => function () {
      return factory(App\SaleLog::class)->create()->id;
    },
    'sale_contracts_id' => function () {
      return factory(App\SaleContract::class)->create()->id;
    },
    'sale_notaries_id' => function () {
      return factory(App\SaleNotary::class)->create()->id;
    },
    'sale_signatures_id' => function () {
      return factory(App\SaleSignature::class)->create()->id;
    },
  ];
});
