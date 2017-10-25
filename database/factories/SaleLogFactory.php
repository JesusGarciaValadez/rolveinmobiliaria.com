<?php

use Faker\Generator as Faker;
use App\Sale;

$factory->define(App\SaleLog::class, function (Faker $faker) {
  $sale_id = $faker->randomElement([
    factory(Sale::class)->create()->id,
    null,
  ]);

  $date = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $subject = $faker->randomElement([
    $faker->sentence(),
    null,
  ]);

  $log_observations = $faker->randomElement([
    $faker->text(),
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
    'sales_id' => $sale_id,
    'date' => $date,
    'subject' => $subject,
    'log_observations' => $log_observations,
    'email' => $email,
    'phone' => $phone,
  ];
});
