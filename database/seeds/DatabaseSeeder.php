<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(RolesTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(StatesTableSeeder::class);

      $this->call(MessagesTableSeeder::class);
      $this->call(CallsTableSeeder::class);
      $this->call(SalesTableSeeder::class);
      $this->call(VisitsTableSeeder::class);
    }
}
