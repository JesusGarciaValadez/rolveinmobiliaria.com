<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleNotariesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_notaries', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('SN_federal_entity', [
          'CDMX',
          'Edo. Mex.',
        ])
        ->default('CDMX');
      $table->string('SN_notarys_office')
            ->nullable();
      $table->date('SN_freedom_of_lien_certificate')
            ->nullable();
      $table->date('SN_zoning')
            ->nullable();
      $table->date('SN_water_no_due_constants')
            ->nullable();
      $table->date('SN_non_debit_proof_of_property')
            ->nullable();
      $table->date('SN_certificate_of_improvement')
            ->nullable();
      $table->date('SN_key_and_cadastral_value')
            ->nullable();
      $table->boolean('SN_complete')
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
    Schema::dropIfExists('sale_notaries');
  }
}
