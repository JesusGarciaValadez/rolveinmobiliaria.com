<?php

use Faker\Generator as Faker;

$factory->define(App\SaleLog::class, function (Faker $faker) {
  return [
    'date' => $faker->date(),
    'subject' => $faker->sentence(),
    'log_observations' => $faker->sentence(),
    'email' => $faker->freeEmail(),
    'phone' => $faker->phoneNumber(),
  ];
});
