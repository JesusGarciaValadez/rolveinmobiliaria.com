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
      'password' => bcrypt('hydra'),
      'role_id' => 1,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Alejandro Rojas',
      'email' => 'alejandro.rojas@rolveinmobiliaria.com',
      'password' => bcrypt('rolve'),
      'role_id' => 2,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => 'Fernanda Ornelas',
      'email' => 'fernanda.ornelas@rolveinmobiliaria.com',
      'password' => bcrypt('odie'),
      'role_id' => 2,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => \App\Enums\RoleType::ASSISTANT,
      'email' => 'asistente@rolveinmobiliaria.com',
      'password' => bcrypt('asistente'),
      'role_id' => 3,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => \App\Enums\RoleType::SALES,
      'email' => 'ventas@rolveinmobiliaria.com',
      'password' => bcrypt('ventas'),
      'role_id' => 4,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => \App\Enums\RoleType::INTERN,
      'email' => 'pasante@rolveinmobiliaria.com',
      'password' => bcrypt('pasante'),
      'role_id' => 5,
      'remember_token' => str_random(10),
    ]);

    factory(App\User::class)->create([
      'name' => \App\Enums\RoleType::CLIENT,
      'email' => 'zerovamp@hotmail.com',
      'password' => bcrypt('cliente'),
      'role_id' => 6,
      'remember_token' => str_random(10),
    ]);

    // factory(App\User::class, 1)->states(\App\Enums\RoleType::ASSISTANT)->create();
    // factory(App\User::class, 1)->states(\App\Enums\RoleType::SALES)->create();
    // factory(App\User::class, 1)->states(\App\Enums\RoleType::INTERN)->create();
    factory(App\User::class, 10)->states(\App\Enums\RoleType::CLIENT)->create();
  }
}
