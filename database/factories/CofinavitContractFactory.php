<?php

use Faker\Generator as Faker;

$factory->define(App\CofinavitContract::class, function (Faker $faker) {

  $type = $faker->randomElement([
    \App\Enums\CivilStatusType::INDIVIDUAL,
    \App\Enums\CivilStatusType::CONJUGAL,
  ]);
  $request_for_credit_inspection = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $birth_certificate = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $official_id = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $curp = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $rfc = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $bank_statement_seller = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $tax_valuation = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $scripture_copy = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $birth_certificate_of_the_spouse = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $official_identification_of_the_spouse = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $marriage_certificate = $faker->randomElement([
    now()->format('U'),
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
    'CC_type' => $type,
    'CC_request_for_credit_inspection'          => $request_for_credit_inspection,
    'CC_birth_certificate'                      => $birth_certificate,
    'CC_official_id'                            => $official_id,
    'CC_curp'                                   => $curp,
    'CC_rfc'                                    => $rfc,
    'CC_bank_statement_seller'                  => $bank_statement_seller,
    'CC_tax_valuation'                          => $tax_valuation,
    'CC_scripture_copy'                         => $scripture_copy,
    'CC_birth_certificate_of_the_spouse'        => $birth_certificate_of_the_spouse,
    'CC_official_identification_of_the_spouse'  => $official_identification_of_the_spouse,
    'CC_marriage_certificate'                   => $marriage_certificate,
    'CC_complete'                               => $complete,
  ];
});
