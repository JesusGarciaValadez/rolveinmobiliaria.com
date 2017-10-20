<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  return [
    'internal_expedients_id' => function () {
      return factory(App\InternalExpedient::class)->create()->id;
    },
  ];
});
