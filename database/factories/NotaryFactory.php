<?php

use Faker\Generator as Faker;

$factory->define(App\Notary::class, function (Faker $faker) {
  $federal_entity = $faker->randomElement([
    'CDMX',
    'Edo. Mex.',
  ]);
  $notaries_office = $faker->randomDigitNotNull();
  $date_freedom_of_lien_certificate = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $observations_freedom_of_lien_certificate = $faker->randomElement([
    $faker->text(),
    null,
  ]);
  $beginning_of_the_certificate_of_freedom_of_assessment = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $zoning = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $water_no_due_constants = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $non_debit_proof_of_property = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $certificate_of_improvement = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $key_and_cadastral_value = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $seller_documents = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $buyer_documents = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $activation_documents_for_the_mortgage_loan = $faker->randomElement([
    now()->format('U'),
    null,
  ]);
  $complete = (
    empty($federal_entity) ||
    empty($notaries_office) ||
    empty($date_freedom_of_lien_certificate) ||
    empty($observations_freedom_of_lien_certificate) ||
    empty($beginning_of_the_certificate_of_freedom_of_assessment) ||
    empty($zoning) ||
    empty($water_no_due_constants) ||
    empty($non_debit_proof_of_property) ||
    empty($certificate_of_improvement) ||
    empty($key_and_cadastral_value) ||
    empty($seller_documents) ||
    empty($buyer_documents) ||
    empty($activation_documents_for_the_mortgage_loan)
  )
    ? false
    : true;

  return [
    'SN_federal_entity'                                         => $federal_entity,
    'SN_notaries_office'                                        => $notaries_office,
    'SN_date_freedom_of_lien_certificate'                       => $date_freedom_of_lien_certificate,
    'SN_observations_freedom_of_lien_certificate'               => $observations_freedom_of_lien_certificate,
    'SN_beginning_of_the_certificate_of_freedom_of_assessment'  => $beginning_of_the_certificate_of_freedom_of_assessment,
    'SN_zoning'                                                 => $zoning,
    'SN_water_no_due_constants'                                 => $water_no_due_constants,
    'SN_non_debit_proof_of_property'                            => $non_debit_proof_of_property,
    'SN_certificate_of_improvement'                             => $certificate_of_improvement,
    'SN_key_and_cadastral_value'                                => $key_and_cadastral_value,
    'SN_seller_documents'                                       => $seller_documents,
    'SN_buyer_documents'                                        => $buyer_documents,
    'SN_activation_documents_for_the_mortgage_loan'             => $activation_documents_for_the_mortgage_loan,
    'SN_complete'                                               => $complete,
  ];
});
