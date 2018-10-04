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
    factory(App\Role::class)->create([
      'name' => \App\Enums\RoleType::SUPER_ADMIN,
    ]);

    factory(App\Role::class)->create([
      'name' => \App\Enums\RoleType::ADMIN,
    ]);

    factory(App\Role::class)->create([
      'name' => \App\Enums\RoleType::ASSISTANT,
    ]);

    factory(App\Role::class)->create([
      'name' => \App\Enums\RoleType::SALES,
    ]);

    factory(App\Role::class)->create([
      'name' => \App\Enums\RoleType::INTERN,
    ]);

    factory(App\Role::class)->create([
      'name' => \App\Enums\RoleType::CLIENT,
    ]);
  }
}
