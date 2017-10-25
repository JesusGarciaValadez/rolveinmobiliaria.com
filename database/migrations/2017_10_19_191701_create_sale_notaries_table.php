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
        ])
        ->default('CDMX');
      $table->string('notarys_office')
            ->nullable();
      $table->date('freedom_of_lien_certificate')
            ->nullable();
      $table->date('zoning')
            ->nullable();
      $table->date('water_no_due_constants')
            ->nullable();
      $table->date('non_debit_proof_of_property')
            ->nullable();
      $table->date('certificate_of_improvement')
            ->nullable();
      $table->date('key_and_cadastral_value')
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
    Schema::dropIfExists('sale_notaries');
  }
}
