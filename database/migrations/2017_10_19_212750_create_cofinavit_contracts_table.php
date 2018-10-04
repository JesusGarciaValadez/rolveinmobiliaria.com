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
          \App\Enums\CivilStatusType::INDIVIDUAL,
          \App\Enums\CivilStatusType::CONJUGAL,
        ])
        ->nullable();
      $table->integer('CC_request_for_credit_inspection')
            ->nullable();
      $table->integer('CC_birth_certificate')
            ->nullable();
      $table->integer('CC_official_id')
            ->nullable();
      $table->integer('CC_curp')
            ->nullable();
      $table->integer('CC_rfc')
            ->nullable();
      $table->integer('CC_bank_statement_seller')
            ->nullable();
      $table->integer('CC_tax_valuation')
            ->nullable();
      $table->integer('CC_scripture_copy')
            ->nullable();
      $table->integer('CC_birth_certificate_of_the_spouse')
            ->nullable();
      $table->integer('CC_official_identification_of_the_spouse')
            ->nullable();
      $table->integer('CC_marriage_certificate')
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
