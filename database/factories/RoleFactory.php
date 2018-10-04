<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
  return [
    'name' => $faker->randomElement([
      \App\Enums\RoleType::SUPER_ADMIN,
      \App\Enums\RoleType::ADMIN,
      \App\Enums\RoleType::ASSISTANT,
      \App\Enums\RoleType::SALES,
      \App\Enums\RoleType::INTERN,
      \App\Enums\RoleType::CLIENT,
    ]),
  ];
});
