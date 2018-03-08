<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InternalExpedientTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\InternalExpedient::class)->create();
  }
}
