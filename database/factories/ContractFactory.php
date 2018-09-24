<?php

use Faker\Generator as Faker;

use App\InfonavitContract;
use App\FovisssteContract;
use App\CofinavitContract;

$factory->define(App\Contract::class, function (Faker $faker) {
  $mortgage_credit = $faker->randomElement([
    'INFONAVIT',
    'FOVISSSTE',
    'COFINAVIT',
    'Bancario',
    'Aliados',
  ]);

  $infonavit_contracts_id = ($mortgage_credit === 'INFONAVIT')
    ? factory(InfonavitContract::class)->create()->id
    : null;

  $fovissste_contracts_id = ($mortgage_credit === 'FOVISSSTE')
    ? factory(FovisssteContract::class)->create()->id
    : null;

  $cofinavit_contracts_id = ($mortgage_credit === 'COFINAVIT')
    ? factory(CofinavitContract::class)->create()->id
    : null;

  $mortgage_broker = ($mortgage_credit === 'Bancario')
    ? \Carbon\Carbon::create()->format('U')
    : null;

  $contract_with_the_broker = ($mortgage_credit === 'Aliados')
    ? \Carbon\Carbon::create()->format('U')
    : null;

  $general_buyer = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);

  $purchase_agreements = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);

  $tax_assessment = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);

  $notary_checklist = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);

  $notary_file = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
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
    empty($mortgage_credit) ||
    empty($general_buyer) ||
    empty($purchase_agreements) ||
    empty($tax_assessment) ||
    empty($notary_checklist) ||
    empty($notary_file)
  )
   ? false
   : true;

  return [
    'SC_infonavit_contracts_id' => $infonavit_contracts_id,
    'SC_fovissste_contracts_id' => $fovissste_contracts_id,
    'SC_cofinavit_contracts_id' => $cofinavit_contracts_id,
    'SC_mortgage_credit' => $mortgage_credit,
    'SC_contract_with_the_broker' => $contract_with_the_broker,
    'SC_mortgage_broker' => $mortgage_broker,
    'SC_general_buyer' => $general_buyer,
    'SC_purchase_agreements' => $purchase_agreements,
    'SC_tax_assessment' => $tax_assessment,
    'SC_notary_checklist' => $notary_checklist,
    'SC_notary_file' => $notary_file,
    'SC_complete' => $complete,
  ];
});
