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

    factory(App\User::class)->create([
      'name' => 'Asistente',
      'email' => 'asistente@rolveinmobiliaria.com',
      'password' => bcrypt('asistente'),
      'role_id' => 3,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Ventas',
      'email' => 'ventas@rolveinmobiliaria.com',
      'password' => bcrypt('ventas'),
      'role_id' => 4,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Pasante',
      'email' => 'pasante@rolveinmobiliaria.com',
      'password' => bcrypt('pasante'),
      'role_id' => 5,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Cliente',
      'email' => 'zerovamp@hotmail.com',
      'password' => bcrypt('cliente'),
      'role_id' => 6,
      'remember_token' => str_random(10),
    ]);

    // factory(App\User::class, 1)->states('assistant')->create();
    // factory(App\User::class, 1)->states('sales')->create();
    // factory(App\User::class, 1)->states('intern')->create();
    factory(App\User::class, 10)->states('client')->create();
  }
}
