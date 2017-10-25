<?php

use Faker\Generator as Faker;

$factory->define(App\FovisssteContract::class, function (Faker $faker) {
  $credit_simulator = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $curp = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $birth_certificate = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $bank_statement = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $single_key_housing_payment = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $general_buyers_and_sellers = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $education_course = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $last_pay_stub = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $complete = (
    empty($credit_simulator) ||
    empty($curp) ||
    empty($birth_certificate) ||
    empty($bank_statement) ||
    empty($single_key_housing_payment) ||
    empty($general_buyers_and_sellers) ||
    empty($education_course) ||
    empty($last_pay_stub)
  )
    ? false
    : true;

  return [
    'credit_simulator' => $credit_simulator,
    'curp' => $curp,
    'birth_certificate' => $birth_certificate,
    'bank_statement' => $bank_statement,
    'single_key_housing_payment' => $single_key_housing_payment,
    'general_buyers_and_sellers' => $general_buyers_and_sellers,
    'education_course' => $education_course,
    'last_pay_stub' => $last_pay_stub,
    'complete' => $complete,
  ];
});
