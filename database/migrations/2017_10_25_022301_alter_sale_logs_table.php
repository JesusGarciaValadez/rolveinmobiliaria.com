<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSaleLogsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('sale_logs', function (Blueprint $table) {
      $table->integer('sales_id')
            ->unsigned()
            ->nullable()
            ->after('id');
      $table->foreign('sales_id')
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
    Schema::table('sale_logs', function (Blueprint $table) {
      $table->dropForeign('sale_logs_sales_id_foreign')
            ->dropColumn('sales_id');
    });
  }
}
