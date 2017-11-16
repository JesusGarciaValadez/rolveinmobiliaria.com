<?php

use Faker\Generator as Faker;

$factory->define(App\SaleSignature::class, function (Faker $faker) {
  $writing_review = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $scheduled_date_of_writing_signature = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $writing_signature = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $scheduled_payment_date = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $payment_made = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $complete = (
    empty($writing_review) ||
    empty($scheduled_date_of_writing_signature) ||
    empty($writing_signature) ||
    empty($scheduled_payment_date) ||
    empty($payment_made)
  )
    ? false
    : true;

  return [
    'SS_writing_review' => $writing_review,
    'SS_scheduled_date_of_writing_signature' => $scheduled_date_of_writing_signature,
    'SS_writing_signature' => $writing_signature,
    'SS_scheduled_payment_date' => $scheduled_payment_date,
    'SS_payment_made' => $payment_made,
    'SS_complete' => $complete,
  ];
});
