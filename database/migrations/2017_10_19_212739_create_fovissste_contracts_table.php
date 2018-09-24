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
      $table->integer('FC_credit_simulator')
            ->nullable();
      $table->integer('FC_curp')
            ->nullable();
      $table->integer('FC_birth_certificate')
            ->nullable();
      $table->integer('FC_bank_statement')
            ->nullable();
      $table->integer('FC_single_key_housing_payment')
            ->nullable();
      $table->integer('FC_general_buyers_and_sellers')
            ->nullable();
      $table->integer('FC_education_course')
            ->nullable();
      $table->integer('FC_last_pay_stub')
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
