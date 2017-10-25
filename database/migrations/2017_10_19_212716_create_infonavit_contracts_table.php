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
      $table->enum('type', [
          'individual',
          'conjugal',
        ])
        ->default('individual');
      $table->date('certified_birth_certificate')
            ->nullable();
      $table->date('official_ID')
            ->nullable();
      $table->date('curp')
            ->nullable();
      $table->date('rfc')
            ->nullable();
      $table->date('spouses_birth_certificate')
            ->nullable();
      $table->date('official_identification_of_the_spouse')
            ->nullable();
      $table->date('marriage_certificate')
            ->nullable();
      $table->date('credit_simulator')
            ->nullable();
      $table->date('credit_application')
            ->nullable();
      $table->date('tax_valuation')
            ->nullable();
      $table->date('bank_statement')
            ->nullable();
      $table->date('workshop_knowing_how_to_decide')
            ->nullable();
      $table->date('retention_sheet')
            ->nullable();
      $table->date('credit_activation')
            ->nullable();
      $table->date('credit_maturity')
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
    Schema::dropIfExists('infonavit_contracts');
  }
}
