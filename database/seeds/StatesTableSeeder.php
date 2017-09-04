<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(\App\State::class)->create([
      'name' => 'Aguascalientes'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Baja California'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Baja California Sur'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Campeche'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Chiapas'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Chihuahua'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Coahuila'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Colima'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Durango'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Estado de México'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Guanajuato'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Guerrero'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Hidalgo'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Jalisco'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Michoacán'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Morelos'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Nayarit'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Nuevo León'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Oaxaca'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Puebla'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Querétaro'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Quintana Roo'
    ]);

    factory(\App\State::class)->create([
      'name' => 'San Luis Potosí'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Sinaloa'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Sonora'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Tabasco'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Tamaulipas'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Tlaxcala'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Veracruz'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Yucatán'
    ]);

    factory(\App\State::class)->create([
      'name' => 'Zacatecas'
    ]);

  }
}
