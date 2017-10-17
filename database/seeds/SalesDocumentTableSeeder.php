<?php

use Illuminate\Database\Seeder;

class SalesDocumentTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    return factory(App\SalesDocument::class, 50)->create();
  }
}
