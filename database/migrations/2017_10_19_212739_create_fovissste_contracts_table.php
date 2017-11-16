<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFovisssteContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fovissste_contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->date('FC_credit_simulator')
            ->nullable();
      $table->date('FC_curp')
            ->nullable();
      $table->date('FC_birth_certificate')
            ->nullable();
      $table->date('FC_bank_statement')
            ->nullable();
      $table->date('FC_single_key_housing_payment')
            ->nullable();
      $table->date('FC_general_buyers_and_sellers')
            ->nullable();
      $table->date('FC_education_course')
            ->nullable();
      $table->date('FC_last_pay_stub')
            ->nullable();
      $table->boolean('FC_complete')
            ->default(true);
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
    Schema::dropIfExists('fovissste_contracts');
  }
}
