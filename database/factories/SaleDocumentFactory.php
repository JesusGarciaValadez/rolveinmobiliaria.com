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
    'SD_predial' => $predial,
    'SD_light' => $light,
    'SD_water' => $water,
    'SD_deed' => $deed,
    'SD_generals_sheet' => $generals_sheet,
    'SD_INE' => $INE,
    'SD_CURP' => $CURP,
    'SD_civil_status' => $civil_status,
    'SD_birth_certificate' => $birth_certificate,
    'SD_account_status' => $account_status,
    'SD_email' => $email,
    'SD_phone' => $phone,
    'SD_complete' => $complete,
  ];
});
