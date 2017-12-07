<?php

use Faker\Generator as Faker;

$factory->define(App\InternalExpedient::class, function (Faker $faker) {
  return [
    'client_id' => function () {
      return factory(App\Client::class)->create()->id;
    },
    'user_id' => function () {
      return factory(App\User::class)->create()->id;
    },
    'expedient' => $faker->swiftBicNumber(),
  ];
});
