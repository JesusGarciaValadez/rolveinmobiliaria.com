<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sales', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('internal_expedients_id')
            ->unsigned()
            ->nullable();
      $table->foreign('internal_expedients_id')
            ->references('id')
            ->on('internal_expedients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_sellers_id')
            ->unsigned()
            ->nullable();
      $table->foreign('sale_sellers_id')
            ->references('id')
            ->on('sale_sellers')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_closing_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('sale_closing_contracts_id')
            ->references('id')
            ->on('sale_closing_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('sale_contracts_id')
            ->references('id')
            ->on('sale_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_notaries_id')
            ->unsigned()
            ->nullable();
      $table->foreign('sale_notaries_id')
            ->references('id')
            ->on('sale_notaries')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_signatures_id')
            ->unsigned()
            ->nullable();
      $table->foreign('sale_signatures_id')
            ->references('id')
            ->on('sale_signatures')
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
    Schema::table('sales', function (Blueprint $table) {
      $table->dropForeign('sales_internal_expedients_id_foreign')
            ->dropColumn('internal_expedients_id');
      $table->dropForeign('sales_sale_sellers_id_foreign')
            ->dropColumn('sale_sellers_id');
      $table->dropForeign('sales_sale_closing_contracts_id_foreign')
            ->dropColumn('sale_closing_contracts_id');
      $table->dropForeign('sales_sale_logs_id_foreign')
            ->dropColumn('sale_logs_id');
      $table->dropForeign('sales_sale_contracts_id_foreign')
            ->dropColumn('sale_contracts_id');
      $table->dropForeign('sales_sale_notaries_id_foreign')
            ->dropColumn('sale_notaries_id');
      $table->dropForeign('sales_sale_signatures_id_foreign')
            ->dropColumn('sale_signatures_id');
      $table->dropForeign('sales_user_id_foreign')
            ->dropColumn('user_id');
    });

    Schema::dropIfExists('sales');
  }
}
