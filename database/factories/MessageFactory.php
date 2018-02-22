<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
  return [
    'user_id' => function ()
    {
      return factory(App\User::class)->create()->id;
    },
    'name' => $faker->name(),
    'email' => $faker->freeEmail(),
    'observations' => $faker->text(),
    'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'America/Mexico_City'),
    'updated_at' => null,
  ];
});
