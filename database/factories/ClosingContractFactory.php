<?php

use Faker\Generator as Faker;

$factory->define(App\ClosingContract::class, function (Faker $faker) {
  $commercial_valuation = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $exclusivity_contract = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $publication = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $data_sheet = $faker->randomElement([
    $faker->file('/tmp', 'public/storage'),
    null,
  ]);
  $closing_contract_observations = $faker->randomElement([
    $faker->text(),
    null,
  ]);
  $complete = (
    empty($commercial_valuation) ||
    empty($exclusivity_contract) ||
    empty($publication) ||
    empty($data_sheet) ||
    empty($closing_contract_observations)
  )
    ? false
    : true;

  return [
    'SCC_commercial_valuation' => $commercial_valuation,
    'SCC_exclusivity_contract' => $exclusivity_contract,
    'SCC_publication' => $publication,
    'SCC_data_sheet' => $data_sheet,
    'SCC_closing_contract_observations' => $closing_contract_observations,
    'SCC_complete' => $complete,
  ];
});
