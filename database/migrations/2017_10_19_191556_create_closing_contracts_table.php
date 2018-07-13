<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosingContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('closing_contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->date('SCC_commercial_valuation')
            ->nullable();
      $table->date('SCC_exclusivity_contract')
            ->nullable();
      $table->date('SCC_publication')
            ->nullable();
      $table->text('SCC_data_sheet')
            ->nullable();
      $table->text('SCC_closing_contract_observations')
            ->nullable();
      $table->boolean('SCC_complete')
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
    Schema::dropIfExists('closing_contracts');
  }
}
