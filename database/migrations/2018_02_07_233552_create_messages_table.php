<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('messages', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('user_id')
            ->unsigned()
            ->nullable();

      $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');

      $table->string('address')
            ->nullable();

      $table->integer('state_id')
            ->unsigned()
            ->nullable()
            ->default('7');

      $table->foreign('state_id')
            ->references('id')
            ->on('states')
            ->onUpdate('cascade')
            ->onDelete('set null');

      $table->text('observations')
            ->nullable();

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
    Schema::table('messages', function (Blueprint $table) {
      $table->dropForeign('messages_user_id_foreign')
            ->dropColumn('user_id');

      $table->dropForeign('messages_state_id_foreign')
            ->dropColumn('state_id');
    });

    Schema::dropIfExists('messages');
  }
}
