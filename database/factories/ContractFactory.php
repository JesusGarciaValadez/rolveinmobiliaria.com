<?php

use Faker\Generator as Faker;

use App\InfonavitContract;
use App\FovisssteContract;
use App\CofinavitContract;

$factory->define(App\Contract::class, function (Faker $faker) {
  $mortgage_credit = $faker->randomElement([
    \App\Enums\MortgageCreditType::INFONAVIT,
    \App\Enums\MortgageCreditType::FOVISSSTE,
    \App\Enums\MortgageCreditType::COFINAVIT,
    \App\Enums\MortgageCreditType::BANKING,
    \App\Enums\MortgageCreditType::ALLIES,
  ]);

  $infonavit_contracts_id = factory(InfonavitContract::class)->create()->id;

  $fovissste_contracts_id = factory(FovisssteContract::class)->create()->id;

  $cofinavit_contracts_id = factory(CofinavitContract::class)->create()->id;

  $mortgage_broker = ($mortgage_credit === \App\Enums\MortgageCreditType::BANKING)
    ? now()->format('U')
    : null;

  $contract_with_the_broker = ($mortgage_credit === \App\Enums\MortgageCreditType::ALLIES)
    ? now()->format('U')
    : null;

  $general_buyer = $faker->randomElement([
    now()->format('U'),
    null,
  ]);

  $purchase_agreements = $faker->randomElement([
    now()->format('U'),
    null,
  ]);

  $tax_assessment = $faker->randomElement([
    now()->format('U'),
    null,
  ]);

  $notary_checklist = $faker->randomElement([
    now()->format('U'),
    null,
  ]);

  $notary_file = $faker->randomElement([
    now()->format('U'),
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
    'SC_infonavit_contracts_id'    => $infonavit_contracts_id,
    'SC_fovissste_contracts_id'    => $fovissste_contracts_id,
    'SC_cofinavit_contracts_id'    => $cofinavit_contracts_id,
    'SC_mortgage_credit'           => $mortgage_credit,
    'SC_contract_with_the_broker'  => $contract_with_the_broker,
    'SC_mortgage_broker'           => $mortgage_broker,
    'SC_general_buyer'             => $general_buyer,
    'SC_purchase_agreements'       => $purchase_agreements,
    'SC_tax_assessment'            => $tax_assessment,
    'SC_notary_checklist'          => $notary_checklist,
    'SC_notary_file'               => $notary_file,
    'SC_complete'                  => $complete,
  ];
});
