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
      factory(\App\Role::class)->create([
        'name' => 'Super Administrador',
        // 'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      factory(\App\Role::class)->create([
        'name' => 'Administrador',
        // 'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      factory(\App\Role::class)->create([
        'name' => 'Asistente',
        // 'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      factory(\App\Role::class)->create([
        'name' => 'Ventas',
        // 'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      factory(\App\Role::class)->create([
        'name' => 'Pasante',
        // 'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      factory(\App\Role::class)->create([
        'name' => 'Cliente',
        // 'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);
    }
}
