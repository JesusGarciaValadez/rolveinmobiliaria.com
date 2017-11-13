<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
  return [
    'first_name' => $faker->firstName() ,
    'last_name' => $faker->lastName() ,
    'phone_1' => $faker->phoneNumber(),
    'phone_2' => $faker->phoneNumber(),
    'business' => $faker->company() ,
    'email' => $faker->freeEmail() ,
    'reference' => $faker->sentence(),
    'user_id' => function ()
    {
      return factory(App\User::class)->states('assistant')->create()->id;
    },
  ];
});
