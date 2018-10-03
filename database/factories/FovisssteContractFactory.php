<?php

use Faker\Generator as Faker;

$factory->define(App\FovisssteContract::class, function (Faker $faker) {
  $credit_simulator = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $curp = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $birth_certificate = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $bank_statement = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $single_key_housing_payment = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $general_buyers_and_sellers = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $education_course = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $last_pay_stub = $faker->randomElement([
    now()->format('U'),
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
    'FC_credit_simulator'            => $credit_simulator,
    'FC_curp'                        => $curp,
    'FC_birth_certificate'           => $birth_certificate,
    'FC_bank_statement'              => $bank_statement,
    'FC_single_key_housing_payment'  => $single_key_housing_payment,
    'FC_general_buyers_and_sellers'  => $general_buyers_and_sellers,
    'FC_education_course'            => $education_course,
    'FC_last_pay_stub'               => $last_pay_stub,
    'FC_complete'                    => $complete,
  ];
});
