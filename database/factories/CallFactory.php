<?php

use Faker\Generator as Faker;

$factory->define(App\Call::class, function (Faker $faker) {
  return [
    'internal_expedient_id' => function ()
    {
      return factory(App\InternalExpedient::class)->create()->id;
    },
    'type_of_operation' => $faker->randomElement([
      \App\Enums\OperationType::SALES,
      \App\Enums\OperationType::RENT,
      \App\Enums\OperationType::EXCLUSIVE_CONTRACTS,
      \App\Enums\OperationType::LEGAL,
      \App\Enums\OperationType::APPRAISALS,
      \App\Enums\OperationType::MESSAGES,
    ]),
    'address' => $faker->address(),
    'user_id' => function ()
    {
      return factory(App\User::class)->states('assistant')->create()->id;
    },
    'observations' => $faker->text(),
    'status' => $faker->sentences(3, true),
    'priority' => $faker->randomElement([
      \App\Enums\PriorityType::LOW,
      \App\Enums\PriorityType::MEDIUM,
      \App\Enums\PriorityType::HIGH,
    ]),
    'state_id' => $faker->numberBetween(1, 32),
  ];
});
