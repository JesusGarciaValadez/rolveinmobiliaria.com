<?php

use Faker\Generator as Faker;

$factory->define(App\SaleLog::class, function (Faker $faker) {
  $date = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $subject = $faker->randomElement([
    $faker->sentence(),
    null,
  ]);

  $log_observations = $faker->randomElement([
    $faker->sentence(),
    null,
  ]);

  $email = $faker->randomElement([
    $faker->freeEmail(),
    null,
  ]);

  $phone = $faker->randomElement([
    $faker->phoneNumber(),
    null,
  ]);

  return [
    'date' => $date,
    'subject' => $subject,
    'log_observations' => $log_observations,
    'email' => $email,
    'phone' => $phone,
  ];
});
