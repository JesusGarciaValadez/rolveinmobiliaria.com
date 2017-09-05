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
      $table->enum('type_of_operation', [
              'Venta',
              'Renta',
              'Regularicación',
              'Jurídico',
              'Sucesión',
            ])
            ->default('Venta');
      $table->string('client_phone_1');
      $table->string('client_phone_2');
      $table->string('email');
      $table->integer('user_id')
            ->unsigned()
            ->nullable();
      $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
      $table->text('observations');
      $table->string('address');
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
