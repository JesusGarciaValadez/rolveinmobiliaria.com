<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('SC_infonavit_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('SC_infonavit_contracts_id')
            ->references('id')
            ->on('infonavit_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('SC_fovissste_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('SC_fovissste_contracts_id')
            ->references('id')
            ->on('fovissste_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->integer('SC_cofinavit_contracts_id')
            ->unsigned()
            ->nullable();
      $table->foreign('SC_cofinavit_contracts_id')
            ->references('id')
            ->on('cofinavit_contracts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->date('SC_mortgage_broker')
            ->nullable();
      $table->date('SC_contract_with_the_broker')
            ->nullable();
      $table->enum('SC_mortgage_credit', [
          'INFONAVIT',
          'FOVISSSTE',
          'COFINAVIT',
          'Bancario',
          'Aliados',
        ])
        ->default('INFONAVIT');
      $table->date('SC_general_buyer')
            ->nullable();
      $table->date('SC_purchase_agreements')
            ->nullable();
      $table->date('SC_tax_assessment')
            ->nullable();
      $table->date('SC_notary_checklist')
            ->nullable();
      $table->date('SC_notary_file')
            ->nullable();
      $table->boolean('SC_complete')
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
    Schema::table('contracts', function (Blueprint $table) {
      $table->dropForeign('contracts_sc_infonavit_contracts_id_foreign')
            ->dropColumn('SC_infonavit_contracts_id');
      $table->dropForeign('contracts_sc_fovissste_contracts_id_foreign')
            ->dropColumn('SC_fovissste_contracts_id');
      $table->dropForeign('contracts_sc_cofinavit_contracts_id_foreign')
            ->dropColumn('SC_cofinavit_contracts_id');
    });

    Schema::dropIfExists('contracts');
  }
}
