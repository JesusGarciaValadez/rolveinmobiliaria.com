<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    return factory(App\Sale::class, 50)->create();
  }
}
