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
    'SL_sales_id' => $sale_id,
    'SL_date' => $date,
    'SL_subject' => $subject,
    'SL_log_observations' => $log_observations,
    'SL_email' => $email,
    'SL_phone' => $phone,
  ];
});
