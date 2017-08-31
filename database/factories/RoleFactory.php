<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
  return [
    'name' => $faker->randomElement([
      'Super Administrador',
      'Administrador',
      'Asistente',
      'Ventas',
      'Pasante',
      'Cliente',
    ]),
  ];
});
