<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
  static $password;

  return [
    'name'            => $faker->name,
    'email'           => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    'role_id'         => 1,
    'remember_token'  => str_random(10),
  ];
});

$factory->state(App\User::class, \App\Enums\RoleType::ADMIN, function (Faker $faker) {
  return [
    'role_id' => 2,
  ];
});

$factory->state(App\User::class, \App\Enums\RoleType::ASSISTANT, function (Faker $faker) {
  return [
    'role_id' => 3,
  ];
});

$factory->state(App\User::class, \App\Enums\RoleType::SALES, function (Faker $faker) {
  return [
    'role_id' => 4,
  ];
});

$factory->state(App\User::class, \App\Enums\RoleType::INTERN, function (Faker $faker) {
  return [
    'role_id' => 5,
  ];
});

$factory->state(App\User::class, \App\Enums\RoleType::CLIENT, function (Faker $faker) {
  return [
    'role_id' => 6,
  ];
});
