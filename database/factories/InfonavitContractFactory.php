<?php

use Faker\Generator as Faker;
use App\Enums\CivilStatusType;

$factory->define(App\InfonavitContract::class, function (Faker $faker) {
  $type = $faker->randomElement([
    \App\Enums\CivilStatusType::INDIVIDUAL,
    \App\Enums\CivilStatusType::CONJUGAL,
  ]);
  $certified_birth_certificate = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $official_ID = $faker->randomElement([
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
  $spouses_birth_certificate = $faker->randomElement([
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
  $credit_simulator = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $credit_application = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $tax_valuation = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $bank_statement = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $workshop_knowing_how_to_decide = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $retention_sheet = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $credit_activation = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $credit_maturity = $faker->randomElement([
    now()->format('U'),
    null,
  ]);

  $complete = (
    empty($type) ||
    empty($certified_birth_certificate) ||
    empty($official_ID) ||
    empty($curp) ||
    empty($rfc) ||
    empty($spouses_birth_certificate) ||
    empty($official_identification_of_the_spouse) ||
    empty($marriage_certificate) ||
    empty($credit_simulator) ||
    empty($credit_application) ||
    empty($tax_valuation) ||
    empty($bank_statement) ||
    empty($workshop_knowing_how_to_decide) ||
    empty($retention_sheet) ||
    empty($credit_activation) ||
    empty($credit_maturity)
  )
    ? false
    : true;

  return [
    'IC_type' => $type,
    'IC_certified_birth_certificate'            => $certified_birth_certificate,
    'IC_official_ID'                            => $official_ID,
    'IC_curp'                                   => $curp,
    'IC_rfc'                                    => $rfc,
    'IC_spouses_birth_certificate'              => $spouses_birth_certificate,
    'IC_official_identification_of_the_spouse'  => $official_identification_of_the_spouse,
    'IC_marriage_certificate'                   => $marriage_certificate,
    'IC_credit_simulator'                       => $credit_simulator,
    'IC_credit_application'                     => $credit_application,
    'IC_tax_valuation'                          => $tax_valuation,
    'IC_bank_statement'                         => $bank_statement,
    'IC_workshop_knowing_how_to_decide'         => $workshop_knowing_how_to_decide,
    'IC_retention_sheet'                        => $retention_sheet,
    'IC_credit_activation'                      => $credit_activation,
    'IC_credit_maturity'                        => $credit_maturity,
    'IC_complete'                               => $complete,
  ];
});
