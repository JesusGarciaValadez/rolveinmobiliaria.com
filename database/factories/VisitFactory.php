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
    empty($subject) ||
    empty($email) ||
    empty($phone) ||
    empty($observations)
  )
    ? false
    : true;

  return [
    'SL_sales_id' => $sale_id,
    'SL_subject' => $subject,
    'SL_email' => $email,
    'SL_phone' => $phone,
    'SL_observations' => $observations,
    'SL_complete' => $complete,
  ];
});
