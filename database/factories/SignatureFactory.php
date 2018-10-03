<?php

use Faker\Generator as Faker;

$factory->define(App\Signature::class, function (Faker $faker) {
  $writing_review = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $scheduled_date_of_writing_signature = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $writing_signature = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $scheduled_payment_date = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $payment_made = $faker->randomElement([
    now()->format('U'),
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
    'SS_writing_review'                       => $writing_review,
    'SS_scheduled_date_of_writing_signature'  => $scheduled_date_of_writing_signature,
    'SS_writing_signature'                    => $writing_signature,
    'SS_scheduled_payment_date'               => $scheduled_payment_date,
    'SS_payment_made'                         => $payment_made,
    'SS_complete'                             => $complete,
  ];
});
