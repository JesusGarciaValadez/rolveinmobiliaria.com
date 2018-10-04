<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('roles', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('name', [
              \App\Enums\RoleType::SUPER_ADMIN,
              \App\Enums\RoleType::ADMIN,
              \App\Enums\RoleType::ASSISTANT, // Seguimiento de llamadas - Agenda de clientes
              \App\Enums\RoleType::SALES, // Seguimiento de llamadas - Agenda de clientes - Compra Venta
              \App\Enums\RoleType::INTERN,
              \App\Enums\RoleType::CLIENT,
            ])
            ->default(\App\Enums\RoleType::CLIENT);
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('roles');
  }
}
