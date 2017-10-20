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
      $table->date('credit_simulator');
      $table->date('curp');
      $table->date('birth_certificate');
      $table->date('bank_statement');
      $table->date('single_key_housing_payment');
      $table->date('general_buyers_and_sellers');
      $table->date('education_course');
      $table->date('last_pay_stub');
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
