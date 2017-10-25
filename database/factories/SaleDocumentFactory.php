<?php

use Faker\Generator as Faker;

$factory->define(App\SaleDocument::class, function (Faker $faker) {
  $predial = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $light = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $water = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $deed = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $generals_sheet = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $INE = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $CURP = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $civil_status = $faker->randomElement([
    'Soltero',
    'Casado',
  ]);
  $birth_certificate = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $account_status = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $email = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $phone = $faker->randomElement([
    $faker->date(),
    null,
  ]);
  $complete = (
    empty($predial) ||
    empty($light) ||
    empty($water) ||
    empty($deed)
  )
    ? false
    : true;
  return [
    'predial' => $predial,
    'light' => $light,
    'water' => $water,
    'deed' => $deed,
    'generals_sheet' => $generals_sheet,
    'INE' => $INE,
    'CURP' => $CURP,
    'civil_status' => $civil_status,
    'birth_certificate' => $birth_certificate,
    'account_status' => $account_status,
    'email' => $email,
    'phone' => $phone,
    'complete' => $complete,
  ];
});
