<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('calls', function (Blueprint $table) {
      $table->increments('id');
      $table->string('expedient')
            ->nullable()
            ->default('Sin número de expediente');
      $table->enum('type_of_operation', [
              'Venta',
              'Renta',
              'Contratos de exclusividad',
              'Jurídico',
              'Avalúos',
            ])
            ->default('Venta');
      $table->string('client');
      $table->string('client_phone_1');
      $table->string('client_phone_2')
            ->nullable();
      $table->string('email')
            ->nullable();
      $table->integer('user_id')
            ->unsigned()
            ->nullable();
      $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
      $table->text('observations')
            ->nullable();
      $table->string('address')
            ->nullable();
      $table->enum('status', [
              'Abierto',
              'Cerrado',
            ])
            ->default('Abierto');
      $table->enum('priority', [
              'Baja',
              'Media',
              'Alta',
            ])
            ->default('Media');
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
    Schema::table('calls', function (Blueprint $table) {
      $table->dropForeign('calls_user_id_foreign')
            ->dropColumn('user_id');
    });

    Schema::dropIfExists('calls');
  }
}
