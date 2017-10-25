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
      $table->date('mortgage_broker')
            ->nullable();
      $table->date('contract_with_the_broker')
            ->nullable();
      $table->enum('mortgage_credit', [
          'INFONAVIT',
          'FOVISSSTE',
          'COFINAVIT',
          'Bancario',
          'Aliados',
        ])
        ->default('INFONAVIT');
      $table->date('general_buyer')
            ->nullable();
      $table->date('purchase_agreements')
            ->nullable();
      $table->date('tax_assessment')
            ->nullable();
      $table->date('notary_checklist')
            ->nullable();
      $table->date('notary_file')
            ->nullable();
      $table->boolean('complete')
            ->default(false);
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
