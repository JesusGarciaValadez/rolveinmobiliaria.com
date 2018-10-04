<?php

use Faker\Generator as Faker;

$factory->define(App\InternalExpedient::class, function (Faker $faker) {
  return [
    'client_id'         => function () {
      return factory(App\Client::class)->create()->id;
    },
    'user_id'           => function () {
      return factory(App\User::class)->create()->id;
    },
    'expedient_key'     => $faker->randomElement([
      \App\Enums\ExpedientKeyType::VNT,
      \App\Enums\ExpedientKeyType::RNT,
      \App\Enums\ExpedientKeyType::CEX,
      \App\Enums\ExpedientKeyType::JRD,
      \App\Enums\ExpedientKeyType::AVA,
    ]),
    'expedient_number'  => $faker->numerify('##'),
    'expedient_year'    => $faker->date('y')
  ];
});
