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
    ]),
    'client' => $faker->name(),
    'client_phone_1' => $faker->phoneNumber(),
    'client_phone_2' => $faker->phoneNumber(),
    'email' => $faker->freeEmail(),
    'user_id' => function () {
      return factory(App\User::class)->states('assistant')->create()->id;
    },
    'observations' => $faker->text(),
    'address' => $faker->address(),
    'status' => $faker->randomElement([
      'Abierto',
      'Cerrado',
    ]),
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
