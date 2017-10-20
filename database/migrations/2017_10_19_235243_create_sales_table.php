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
            ->unsigned();
      $table->foreign('internal_expedients_id')
            ->references('id')
            ->on('internal_expedients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_documents_id')
            ->unsigned();
      $table->foreign('sale_documents_id')
            ->references('id')
            ->on('sale_documents')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_closing_contracts_id')
            ->unsigned();
      $table->foreign('sale_closing_contracts_id')
            ->references('id')
            ->on('sale_closing_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_logs_id')
            ->unsigned();
      $table->foreign('sale_logs_id')
            ->references('id')
            ->on('sale_logs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_contracts_id')
            ->unsigned();
      $table->foreign('sale_contracts_id')
            ->references('id')
            ->on('sale_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_notaries_id')
            ->unsigned();
      $table->foreign('sale_notaries_id')
            ->references('id')
            ->on('sale_notaries')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('sale_signatures_id')
            ->unsigned();
      $table->foreign('sale_signatures_id')
            ->references('id')
            ->on('sale_signatures')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
      $table->dropForeign('sales_sale_documents_id_foreign')
            ->dropColumn('sale_documents_id');
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
    });

    Schema::dropIfExists('sales');
  }
}
