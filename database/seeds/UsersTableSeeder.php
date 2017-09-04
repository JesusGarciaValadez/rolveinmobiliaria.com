<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\User::class)->create([
      'name' => 'Jesús García',
      'email' => 'jesus.garciav@me.com',
      'password' => bcrypt('_Asukal01_'),
      'role_id' => 1,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Alejandro Rojas',
      'email' => 'alejandro.rojas@rolveinmobiliaria.com',
      'password' => bcrypt('7raveler'),
      'role_id' => 2,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Fernanda Ornelas',
      'email' => 'fernanda.ornelas@rolveinmobiliaria.com',
      'password' => bcrypt('OdieGarciaOrnelas123'),
      'role_id' => 2,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class, 1)->states('assistant')->create();
    factory(App\User::class, 1)->states('sales')->create();
    factory(App\User::class, 1)->states('intern')->create();
    factory(App\User::class, 10)->states('client')->create();
  }
}
