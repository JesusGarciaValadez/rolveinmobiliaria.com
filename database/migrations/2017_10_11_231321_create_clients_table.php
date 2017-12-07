<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('clients', function (Blueprint $table) {
      $table->increments('id');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('phone_1');
      $table->string('phone_2')
            ->nullable();
      $table->string('business')
            ->nullable();
      $table->string('email')
            ->nullable();
      $table->string('reference')
            ->nullable();
      $table->integer('user_id')
            ->unsigned()
            ->nullable();
      $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
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
    Schema::dropIfExists('clients');
  }
}
