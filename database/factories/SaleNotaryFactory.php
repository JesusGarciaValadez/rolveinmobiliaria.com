<?php

use Faker\Generator as Faker;

$factory->define(App\SaleNotary::class, function (Faker $faker) {
  $federal_entity = $faker->randomElement([
    'CDMX',
    'Edo. Mex.',
  ]);
  $notaries_office = $faker->randomDigitNotNull();
  $freedom_of_lien_certificate = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $zoning = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $water_no_due_constants = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $non_debit_proof_of_property = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $certificate_of_improvement = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $key_and_cadastral_value = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $complete = (
    empty($federal_entity) ||
    empty($notaries_office) ||
    empty($freedom_of_lien_certificate) ||
    empty($zoning) ||
    empty($water_no_due_constants) ||
    empty($non_debit_proof_of_property) ||
    empty($certificate_of_improvement) ||
    empty($key_and_cadastral_value)
  )
    ? false
    : true;

  return [
    'SN_federal_entity' => $federal_entity,
    'SN_notaries_office' => $notaries_office,
    'SN_freedom_of_lien_certificate' => $freedom_of_lien_certificate,
    'SN_zoning' => $zoning,
    'SN_water_no_due_constants' => $water_no_due_constants,
    'SN_non_debit_proof_of_property' => $non_debit_proof_of_property,
    'SN_certificate_of_improvement' => $certificate_of_improvement,
    'SN_key_and_cadastral_value' => $key_and_cadastral_value,
    'SN_complete' => $complete,
  ];
});
