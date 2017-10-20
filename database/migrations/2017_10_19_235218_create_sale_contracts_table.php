<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('infonavit_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('infonavit_contracts_id')
            ->references('id')
            ->on('infonavit_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('fovissste_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('fovissste_contracts_id')
            ->references('id')
            ->on('fovissste_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('cofinavit_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('cofinavit_contracts_id')
            ->references('id')
            ->on('cofinavit_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->enum('mortgage_credit', [
          'INFONAVIT',
          'FOVISSSTE',
          'COFINATIV',
          'Bancario',
          'Aliados',
        ]);
      $table->date('general_buyer');
      $table->date('purchase_agreements');
      $table->date('tax_assessment');
      $table->date('notary_checklist');
      $table->date('notary_file');
      $table->date('contract_with_the_broquet')
            ->nullable();
      $table->date('mortgage_broker')
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
    Schema::table('sale_contracts', function (Blueprint $table) {
      $table->dropForeign('sale_contracts_infonavit_contracts_id_foreign')
            ->dropColumn('infonavit_contracts_id');
      $table->dropForeign('sale_contracts_fovissste_contracts_id_foreign')
            ->dropColumn('fovissste_contracts_id');
      $table->dropForeign('sale_contracts_cofinavit_contracts_id_foreign')
            ->dropColumn('cofinavit_contracts_id');
    });

    Schema::dropIfExists('sale_contracts');
  }
}
