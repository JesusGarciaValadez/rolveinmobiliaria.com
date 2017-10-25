<?php

use Faker\Generator as Faker;

$factory->define(App\CofinavitContract::class, function (Faker $faker) {
  $type = $faker->randomElement([
    'individual',
    'conjugal',
  ]);
  $request_for_credit_inspection = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $birth_certificate = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $official_id = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $curp = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $rfc = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $bank_statement_seller = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $tax_valuation = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $scripture_copy = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $birth_certificate_of_the_spouse = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $official_identification_of_the_spouse = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $marriage_certificate = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $complete = (
    empty($type) ||
    empty($request_for_credit_inspection) ||
    empty($birth_certificate) ||
    empty($official_id) ||
    empty($curp) ||
    empty($rfc) ||
    empty($bank_statement_seller) ||
    empty($tax_valuation) ||
    empty($scripture_copy) ||
    empty($birth_certificate_of_the_spouse) ||
    empty($official_identification_of_the_spouse) ||
    empty($marriage_certificate)
  )
    ? false
    : true;

  return [
    'type' => $type,
    'request_for_credit_inspection' => $request_for_credit_inspection,
    'birth_certificate' => $birth_certificate,
    'official_id' => $official_id,
    'curp' => $curp,
    'rfc' => $rfc,
    'bank_statement_seller' => $bank_statement_seller,
    'tax_valuation' => $tax_valuation,
    'scripture_copy' => $scripture_copy,
    'birth_certificate_of_the_spouse' => $birth_certificate_of_the_spouse,
    'official_identification_of_the_spouse' => $official_identification_of_the_spouse,
    'marriage_certificate' => $marriage_certificate,
    'complete' => $complete,
  ];
});
