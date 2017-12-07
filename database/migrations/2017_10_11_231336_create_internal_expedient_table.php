<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalExpedientTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('internal_expedients', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('client_id')
            ->unsigned();
      $table->foreign('client_id')
            ->references('id')
            ->on('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('user_id')
            ->unsigned()
            ->nullable();
      $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
      $table->string('expedient')
            ->nullable()
            ->default('Sin expediente');
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
    Schema::table('internal_expedients', function (Blueprint $table) {
      $table->dropForeign('internal_expedients_client_id_foreign')
            ->dropColumn('client_id');
    });

    Schema::dropIfExists('internal_expedients');
  }
}
