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
        ]);
      $table->date('certified birth certificate');
      $table->date('official ID');
      $table->date('curp');
      $table->date('rfc');
      $table->date('spouses_birth_certificate')
            ->nullable();
      $table->date('official_identification_of_the_spouse')
            ->nullable();
      $table->date('marriage_certificate')
            ->nullable();
      $table->date('credit_simulator');
      $table->date('credit_application');
      $table->date('tax_valuation');
      $table->date('bank_statement');
      $table->date('workshop_knowing_how_to_decide');
      $table->date('retention_sheet');
      $table->date('credit_activation');
      $table->date('credit_maturity');
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
