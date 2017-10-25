<?php

use Faker\Generator as Faker;

use App\InfonavitContract;
use App\FovisssteContract;
use App\CofinavitContract;

$factory->define(App\SaleContract::class, function (Faker $faker) {
  $mortgage_credit = $faker->randomElement([
    'INFONAVIT',
    'FOVISSSTE',
    'COFINAVIT',
    'Bancario',
    'Aliados',
  ]);

  $infonavit_contracts_id = ($mortgage_credit == 'INFONAVIT')
    ? factory(InfonavitContract::class)->create()->id
    : null;

  $fovissste_contracts_id = ($mortgage_credit == 'FOVISSSTE')
    ? factory(FovisssteContract::class)->create()->id
    : null;

  $cofinavit_contracts_id = ($mortgage_credit == 'COFINAVIT')
    ? factory(CofinavitContract::class)->create()->id
    : null;

  $mortgage_broker = ($mortgage_credit == 'Bancario')
    ? $faker->date()
    : null;

  $contract_with_the_broker = ($mortgage_credit == 'Aliados')
    ? $faker->date()
    : null;

  $general_buyer = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $purchase_agreements = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $tax_assessment = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $notary_checklist = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $notary_file = $faker->randomElement([
    $faker->date(),
    null,
  ]);

  $complete = (
    (
      empty($infonavit_contracts_id) ||
      empty($fovissste_contracts_id) ||
      empty($cofinavit_contracts_id) ||
      empty($mortgage_broker) ||
      empty($contract_with_the_broker)
    ) &&
    empty($mortgage_credit) &&
    empty($general_buyer) &&
    empty($purchase_agreements) &&
    empty($tax_assessment) &&
    empty($notary_checklist) &&
    empty($notary_file)
  )
   ? false
   : true;

  return [
    'infonavit_contracts_id' => $infonavit_contracts_id,
    'fovissste_contracts_id' => $fovissste_contracts_id,
    'cofinavit_contracts_id' => $cofinavit_contracts_id,
    'mortgage_broker' => $mortgage_broker,
    'contract_with_the_broker' => $contract_with_the_broker,
    'mortgage_credit' => $mortgage_credit,
    'general_buyer' => $general_buyer,
    'purchase_agreements' => $purchase_agreements,
    'tax_assessment' => $tax_assessment,
    'notary_checklist' => $notary_checklist,
    'notary_file' => $notary_file,
    'complete' => $complete,
  ];
});
