<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotariesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('notaries', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('SN_federal_entity', [
          'CDMX',
          'Edo. Mex.',
        ])
        ->default('CDMX');
      $table->string('SN_notaries_office')
            ->nullable();
      $table->integer('SN_date_freedom_of_lien_certificate')
            ->nullable();
      $table->text('SN_observations_freedom_of_lien_certificate')
            ->nullable();
      $table->integer('SN_beginning_of_the_certificate_of_freedom_of_assessment')
            ->nullable();
      $table->integer('SN_zoning')
            ->nullable();
      $table->integer('SN_water_no_due_constants')
            ->nullable();
      $table->integer('SN_non_debit_proof_of_property')
            ->nullable();
      $table->integer('SN_certificate_of_improvement')
            ->nullable();
      $table->integer('SN_key_and_cadastral_value')
            ->nullable();
      $table->integer('SN_seller_documents')
            ->nullable();
      $table->integer('SN_buyer_documents')
            ->nullable();
      $table->integer('SN_activation_documents_for_the_mortgage_loan')
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
    Schema::dropIfExists('notaries');
  }
}
