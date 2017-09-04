<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCallsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('calls', function (Blueprint $table) {
      $table->integer('state_id')
            ->unsigned();
      $table->foreign('state_id')
            ->references('id')
            ->on('states');
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
      $table->dropForeign('calls_state_id_foreign')
            ->dropColumn('state_id');
    });
  }
}
