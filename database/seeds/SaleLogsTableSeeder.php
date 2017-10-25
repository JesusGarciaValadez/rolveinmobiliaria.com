<?php

use Illuminate\Database\Seeder;

class SaleLogsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    return factory(App\SaleLog::class, 20)->create();
  }
}
