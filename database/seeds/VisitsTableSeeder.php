<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    return factory(App\Visit::class, 20)->create();
  }
}
