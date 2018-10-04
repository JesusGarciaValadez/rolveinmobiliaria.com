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
    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::AGUASCALIENTES,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::BAJA_CALIFORNIA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::BAJA_CALIFORNIA_SUR,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::CAMPECHE,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::CHIAPAS,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::CHIHUAHUA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::CIUDAD_DE_MEXICO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::COAHUILA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::COLIMA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::DURANGO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::ESTADO_DE_MEXICO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::GUANAJUATO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::GUERRERO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::HIDALGO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::JALISCO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::MICHOACAN,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::MORELOS,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::NAYARIT,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::NUEVO_LEON,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::OAXACA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::PUEBLA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::QUERETARO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::QUINTANA_ROO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::SAN_LUIS_POTOSI,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::SINALOA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::SONORA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::TABASCO,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::TAMAULIPAS,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::TLAXCALA,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::VERACRUZ,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::YUCATAN,
    ]);

    factory(App\State::class)->create([
      'name' => \App\Enums\FederalEntityType::ZACATECAS,
    ]);

  }
}
