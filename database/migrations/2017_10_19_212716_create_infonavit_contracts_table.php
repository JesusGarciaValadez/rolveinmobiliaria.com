<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfonavitContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('infonavit_contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('IC_type', [
          'Individual',
          'Conyugal',
        ])
        ->nullable();
      $table->integer('IC_certified_birth_certificate')
            ->nullable();
      $table->integer('IC_official_ID')
            ->nullable();
      $table->integer('IC_curp')
            ->nullable();
      $table->integer('IC_rfc')
            ->nullable();
      $table->integer('IC_spouses_birth_certificate')
            ->nullable();
      $table->integer('IC_official_identification_of_the_spouse')
            ->nullable();
      $table->integer('IC_marriage_certificate')
            ->nullable();
      $table->integer('IC_credit_simulator')
            ->nullable();
      $table->integer('IC_credit_application')
            ->nullable();
      $table->integer('IC_tax_valuation')
            ->nullable();
      $table->integer('IC_bank_statement')
            ->nullable();
      $table->integer('IC_workshop_knowing_how_to_decide')
            ->nullable();
      $table->integer('IC_retention_sheet')
            ->nullable();
      $table->integer('IC_credit_activation')
            ->nullable();
      $table->integer('IC_credit_maturity')
            ->nullable();
      $table->boolean('IC_complete')
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
    Schema::dropIfExists('infonavit_contracts');
  }
}
