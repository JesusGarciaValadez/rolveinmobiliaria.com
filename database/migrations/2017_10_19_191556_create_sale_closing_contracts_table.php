<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleClosingContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_closing_contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->date('commercial_valuation');
      $table->date('exclusivity_contract');
      $table->date('publication');
      $table->string('data_sheet');
      $table->string('closing_contract_observations');
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
    Schema::dropIfExists('sale_closing_contracts');
  }
}
