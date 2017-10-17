<?php

use Illuminate\Database\Seeder;

class InternalExpedientTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\InternalExpedient::class, 50)->create();
  }
}
