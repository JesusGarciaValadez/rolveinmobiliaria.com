<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  return [
    'internal_expedients_id' => function () {
      return factory(App\InternalExpedient::class)->create()->id;
    },
    'predial' => $faker->date('Y-m-d', 'now'),
    'light' => $faker->date('Y-m-d', 'now'),
    'water' => $faker->date('Y-m-d', 'now'),
    'deed' => $faker->date('Y-m-d', 'now'),
    'generals_sheet' => $faker->date('Y-m-d', 'now'),
    'INE' => $faker->date('Y-m-d', 'now'),
    'CURP' => $faker->date('Y-m-d', 'now'),
    'civil_status' => $faker->randomElement([
      'Soltero',
      'Casado',
    ]),
    'birth_certificate' => $faker->date('Y-m-d', 'now'),
    'account_status' => $faker->date('Y-m-d', 'now'),
    'email' => $faker->freeEmail(),
    'phone' => $faker->phoneNumber(),
  ];
});
