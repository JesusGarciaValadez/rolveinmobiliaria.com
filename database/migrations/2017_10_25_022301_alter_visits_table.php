<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVisitsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('visits', function (Blueprint $table) {
      $table->integer('SV_sales_id')
            ->unsigned()
            ->nullable()
            ->after('id');
      $table->foreign('SV_sales_id')
            ->references('id')
            ->on('sales')
            ->onUpdate('cascade')
            ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('visits', function (Blueprint $table) {
      $table->dropForeign('visits_sv_sales_id_foreign')
            ->dropColumn('SV_sales_id');
    });
  }
}
