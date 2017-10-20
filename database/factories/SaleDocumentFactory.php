<?php

use Faker\Generator as Faker;

$factory->define(App\SaleDocument::class, function (Faker $faker) {
  return [
    'predial' => $faker->date(),
    'light' => $faker->date(),
    'water' => $faker->date(),
    'deed' => $faker->date(),
    'generals_sheet' => $faker->date(),
    'INE' => $faker->date(),
    'CURP' => $faker->date(),
    'civil_status', => $faker->randomElement([
      'Soltero',
      'Casado',
    ]),
    'birth_certificate' => $faker->date(),
    'account_status' => $faker->date(),
    'email' => $faker->freeEmail(),
    'phone' => $faker->phoneNumber(),
  ];
});
