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
        ])
        ->default('individual');
      $table->date('request_for_credit_inspection')
            ->nullable();
      $table->date('birth_certificate')
            ->nullable();
      $table->date('official_id')
            ->nullable();
      $table->date('curp')
            ->nullable();
      $table->date('rfc')
            ->nullable();
      $table->date('bank_statement_seller')
            ->nullable();
      $table->date('tax_valuation')
            ->nullable();
      $table->date('scripture_copy')
            ->nullable();
      $table->date('birth_certificate_of_the_spouse')
            ->nullable();
      $table->date('official_identification_of_the_spouse')
            ->nullable();
      $table->date('marriage_certificate')
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
    Schema::dropIfExists('cofinavit_contracts');
  }
}
