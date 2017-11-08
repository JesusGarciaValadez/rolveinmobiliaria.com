<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Role::class)->create([
      'name' => 'Super Administrador',
    ]);

    factory(App\Role::class)->create([
      'name' => 'Administrador',
    ]);

    factory(App\Role::class)->create([
      'name' => 'Asistente',
    ]);

    factory(App\Role::class)->create([
      'name' => 'Ventas',
    ]);

    factory(App\Role::class)->create([
      'name' => 'Pasante',
    ]);

    factory(App\Role::class)->create([
      'name' => 'Cliente',
    ]);
  }
}
