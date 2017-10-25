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
      $table->date('commercial_valuation')
            ->nullable();
      $table->date('exclusivity_contract')
            ->nullable();
      $table->date('publication')
            ->nullable();
      $table->text('data_sheet')
            ->nullable();
      $table->text('closing_contract_observations')
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
    Schema::dropIfExists('sale_closing_contracts');
  }
}
