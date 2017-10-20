<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCofinavitContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cofinavit_contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('type', [
          'individual',
          'conjugal',
        ]);
      $table->date('request_for_credit_inspection');
      $table->date('birth_certificate');
      $table->date('official_id');
      $table->date('curp');
      $table->date('rfc');
      $table->date('bank_statement_seller');
      $table->date('tax_valuation');
      $table->date('scripture_copy');
      $table->date('birth_certificate_of_the_spouse');
      $table->date('official_identification_of_the_spouse');
      $table->date('marriage_certificate');
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
    Schema::dropIfExists('cofinavit_contracts');
  }
}
