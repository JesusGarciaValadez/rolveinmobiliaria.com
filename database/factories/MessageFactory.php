<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
  return [
    'user_id' => function ()
    {
      return factory(App\User::class)->states('assistant')->create()->id;
    },
    'address' => $faker->address(),
    'state_id' => $faker->numberBetween(1, 32),
    'observations' => $faker->text(),
    'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'America/Mexico_City'),
    'updated_at' => null,
  ];
});
