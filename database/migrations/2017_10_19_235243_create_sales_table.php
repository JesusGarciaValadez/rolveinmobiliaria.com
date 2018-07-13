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
      $table->integer('sellers_id')
            ->unsigned()
            ->nullable();
      $table->foreign('sellers_id')
            ->references('id')
            ->on('sellers')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('closing_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('closing_contracts_id')
            ->references('id')
            ->on('closing_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('visits_id')
            ->unsigned()
            ->nullable();
      $table->foreign('visits_id')
            ->references('id')
            ->on('visits')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('contracts_id')
            ->references('id')
            ->on('contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('notaries_id')
            ->unsigned()
            ->nullable();
      $table->foreign('notaries_id')
            ->references('id')
            ->on('notaries')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('signatures_id')
            ->unsigned()
            ->nullable();
      $table->foreign('signatures_id')
            ->references('id')
            ->on('signatures')
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
      $table->dropForeign('sales_sellers_id_foreign')
            ->dropColumn('sellers_id');
      $table->dropForeign('sales_closing_contracts_id_foreign')
            ->dropColumn('closing_contracts_id');
      $table->dropForeign('sales_visits_id_foreign')
            ->dropColumn('visits_id');
      $table->dropForeign('sales_contracts_id_foreign')
            ->dropColumn('contracts_id');
      $table->dropForeign('sales_notaries_id_foreign')
            ->dropColumn('notaries_id');
      $table->dropForeign('sales_signatures_id_foreign')
            ->dropColumn('signatures_id');
      $table->dropForeign('sales_user_id_foreign')
            ->dropColumn('user_id');
    });

    Schema::dropIfExists('sales');
  }
}
