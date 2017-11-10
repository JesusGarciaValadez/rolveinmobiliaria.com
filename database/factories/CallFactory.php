<?php

use Faker\Generator as Faker;

$factory->define(App\Call::class, function (Faker $faker) {
  return [
    'expedient' => $faker->swiftBicNumber(),
    'type_of_operation' => $faker->randomElement([
      'Venta',
      'Renta',
      'Contratos de exclusividad',
      'Jurídico',
      'Avalúos',
      'Recados',
    ]),
    'address' => $faker->address(),
    'client_id' => function ()
    {
      return factory(App\Client::class)->create()->id;
    },
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
    'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'America/Mexico_City'),
    'updated_at' => null,
  ];
});
