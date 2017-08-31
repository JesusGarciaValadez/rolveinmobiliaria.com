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
      DB::table('roles')->insert([
        'name' => 'Super Administrador',
        'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      DB::table('roles')->insert([
        'name' => 'Administrador',
        'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      DB::table('roles')->insert([
        'name' => 'Asistente',
        'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      DB::table('roles')->insert([
        'name' => 'Ventas',
        'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      DB::table('roles')->insert([
        'name' => 'Pasante',
        'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);

      DB::table('roles')->insert([
        'name' => 'Cliente',
        'created_at' => Carbon::now('America/Mexico_City')->toDateTimeString(),
      ]);
    }
}
