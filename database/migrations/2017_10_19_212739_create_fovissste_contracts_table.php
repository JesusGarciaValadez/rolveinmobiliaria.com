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
      $table->date('credit_simulator')
            ->nullable();
      $table->date('curp')
            ->nullable();
      $table->date('birth_certificate')
            ->nullable();
      $table->date('bank_statement')
            ->nullable();
      $table->date('single_key_housing_payment')
            ->nullable();
      $table->date('general_buyers_and_sellers')
            ->nullable();
      $table->date('education_course')
            ->nullable();
      $table->date('last_pay_stub')
            ->nullable();
      $table->boolean('complete')
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
