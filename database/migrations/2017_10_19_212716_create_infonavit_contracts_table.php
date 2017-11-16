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
          'individual',
          'conjugal',
        ])
        ->default('individual');
      $table->date('IC_certified_birth_certificate')
            ->nullable();
      $table->date('IC_official_ID')
            ->nullable();
      $table->date('IC_curp')
            ->nullable();
      $table->date('IC_rfc')
            ->nullable();
      $table->date('IC_spouses_birth_certificate')
            ->nullable();
      $table->date('IC_official_identification_of_the_spouse')
            ->nullable();
      $table->date('IC_marriage_certificate')
            ->nullable();
      $table->date('IC_credit_simulator')
            ->nullable();
      $table->date('IC_credit_application')
            ->nullable();
      $table->date('IC_tax_valuation')
            ->nullable();
      $table->date('IC_bank_statement')
            ->nullable();
      $table->date('IC_workshop_knowing_how_to_decide')
            ->nullable();
      $table->date('IC_retention_sheet')
            ->nullable();
      $table->date('IC_credit_activation')
            ->nullable();
      $table->date('IC_credit_maturity')
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
