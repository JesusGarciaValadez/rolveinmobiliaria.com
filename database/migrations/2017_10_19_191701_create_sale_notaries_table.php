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
      $table->enum('federal_entity', [
          'CDMX',
          'Edo. Mex.',
        ]);
      $table->string('notarys_office');
      $table->date('freedom_of_lien_certificate');
      $table->date('zoning');
      $table->date('water_no-due_constants');
      $table->date('non_debit_proof_of_property');
      $table->date('certificate_of_improvement');
      $table->date('key_and_cadastral_value');
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
