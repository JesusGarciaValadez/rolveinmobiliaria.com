<?php

use Faker\Generator as Faker;

$factory->define(App\Call::class, function (Faker $faker) {
  return [
    'internal_expedient_id' => function ()
    {
      return factory(App\InternalExpedient::class)->create()->id;
    },
    'type_of_operation' => $faker->randomElement([
      'Venta',
      'Renta',
      'Contratos de exclusividad',
      'Jurídico',
      'Avalúos',
      'Recados',
    ]),
    'address' => $faker->address(),
    'user_id' => function ()
    {
      return factory(App\User::class)->states('assistant')->create()->id;
    },
    'observations' => $faker->text(),
    'status' => $faker->sentences(3, true),
    'priority' => $faker->randomElement([
      'Baja',
      'Media',
      'Alta',
    ]),
    'state_id' => $faker->numberBetween(1, 32),
  ];
});
