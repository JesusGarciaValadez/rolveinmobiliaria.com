<?php

use Faker\Generator as Faker;
use App\Sale;

$factory->define(App\Visit::class, function (Faker $faker) {
  $sale_id = $faker->randomElement([
    factory(Sale::class)->create()->id,
    null,
  ]);

  $subject = $faker->randomElement([
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

  $observations = $faker->randomElement([
    $faker->text(),
    null,
  ]);

  $complete = (
    empty($sale_id) ||
    empty($subject) ||
    empty($email) ||
    empty($phone) ||
    empty($observations)
  )
    ? false
    : true;

  return [
    'SV_sales_id' => $sale_id,
    'SV_subject' => $subject,
    'SV_email' => $email,
    'SV_phone' => $phone,
    'SV_observations' => $observations,
    'SV_complete' => $complete,
  ];
});
