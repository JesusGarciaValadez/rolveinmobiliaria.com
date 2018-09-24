<?php

use Faker\Generator as Faker;

$factory->define(App\Seller::class, function (Faker $faker) {
  $deed = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $water = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $predial = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $light = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $birth_certificate = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $ID = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $CURP = $faker->swiftBicNumber();
  $RFC = $faker->swiftBicNumber();
  $account_status = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $email = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $phone = $faker->randomElement([
    \Carbon\Carbon::create()->format('U'),
    null,
  ]);
  $civil_status = $faker->randomElement([
    'Soltero',
    'Casado',
  ]);
  $complete = (
    empty($deed) ||
    empty($water) ||
    empty($predial) ||
    empty($light) ||
    empty($birth_certificate) ||
    empty($ID) ||
    empty($CURP) ||
    empty($RFC) ||
    empty($account_status) ||
    empty($email) ||
    empty($phone) ||
    empty($civil_status) ||
    empty($complete)
  )
    ? false
    : true;
  return [
    'SD_deed' => $deed,
    'SD_water' => $water,
    'SD_predial' => $predial,
    'SD_light' => $light,
    'SD_birth_certificate' => $birth_certificate,
    'SD_ID' => $ID,
    'SD_CURP' => $CURP,
    'SD_RFC' => $RFC,
    'SD_account_status' => $account_status,
    'SD_email' => $email,
    'SD_phone' => $phone,
    'SD_civil_status' => $civil_status,
    'SD_complete' => $complete,
  ];
});
