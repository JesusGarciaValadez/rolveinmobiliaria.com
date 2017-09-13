<?php

use Faker\Generator as Faker;

$factory->define(App\Call::class, function (Faker $faker) {
  return [
    'type_of_operation' => $faker->randomElement([
      'Venta',
      'Renta',
      'Regularización',
      'Jurídico',
      'Sucesión',
    ]),
    'client_phone_1' => $faker->phoneNumber(),
    'client_phone_2' => $faker->phoneNumber(),
    'email' => $faker->freeEmail(),
    'user_id' => function () {
      return factory(App\User::class)->states('assistant')->create()->id;
    },
    'observations' => $faker->text(),
    'address' => $faker->address(),
    'state_id' => $faker->numberBetween(1, 32),
  ];
});
