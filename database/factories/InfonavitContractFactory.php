<?php

use Faker\Generator as Faker;

$factory->define(App\InfonavitContract::class, function (Faker $faker) {
  $type = $faker->randomElement([
    'individual',
    'conjugal',
  ]);
  $certified_birth_certificate = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $official_ID = $faker->randomElement([
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
  $spouses_birth_certificate = $faker->randomElement([
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
  $credit_simulator = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $credit_application = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $tax_valuation = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $bank_statement = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $workshop_knowing_how_to_decide = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $retention_sheet = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $credit_activation = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $credit_maturity = $faker->randomElement([
    $faker->date(),
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
    'type' => $type,
    'certified_birth_certificate' => $certified_birth_certificate,
    'official_ID' => $official_ID,
    'curp' => $curp,
    'rfc' => $rfc,
    'spouses_birth_certificate' => $spouses_birth_certificate,
    'official_identification_of_the_spouse' => $official_identification_of_the_spouse,
    'marriage_certificate' => $marriage_certificate,
    'credit_simulator' => $credit_simulator,
    'credit_application' => $credit_application,
    'tax_valuation' => $tax_valuation,
    'bank_statement' => $bank_statement,
    'workshop_knowing_how_to_decide' => $workshop_knowing_how_to_decide,
    'retention_sheet' => $retention_sheet,
    'credit_activation' => $credit_activation,
    'credit_maturity' => $credit_maturity,
    'complete' => $complete,
  ];
});
