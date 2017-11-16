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
      $table->enum('CC_type', [
          'individual',
          'conjugal',
        ])
        ->default('individual');
      $table->date('CC_request_for_credit_inspection')
            ->nullable();
      $table->date('CC_birth_certificate')
            ->nullable();
      $table->date('CC_official_id')
            ->nullable();
      $table->date('CC_curp')
            ->nullable();
      $table->date('CC_rfc')
            ->nullable();
      $table->date('CC_bank_statement_seller')
            ->nullable();
      $table->date('CC_tax_valuation')
            ->nullable();
      $table->date('CC_scripture_copy')
            ->nullable();
      $table->date('CC_birth_certificate_of_the_spouse')
            ->nullable();
      $table->date('CC_official_identification_of_the_spouse')
            ->nullable();
      $table->date('CC_marriage_certificate')
            ->nullable();
      $table->boolean('CC_complete')
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
    Schema::dropIfExists('cofinavit_contracts');
  }
}
