<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDocumentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_documents', function (Blueprint $table) {
      $table->increments('id');
      $table->date('SD_predial')
            ->nullable();
      $table->date('SD_light')
            ->nullable();
      $table->date('SD_water')
            ->nullable();
      $table->date('SD_deed')
            ->nullable();
      $table->date('SD_generals_sheet')
            ->nullable();
      $table->date('SD_INE')
            ->nullable();
      $table->date('SD_CURP')
            ->nullable();
      $table->enum('SD_civil_status', [
          'Soltero',
          'Casado',
        ])
        ->default('Soltero');
      $table->date('SD_birth_certificate')
            ->nullable();
      $table->date('SD_account_status')
            ->nullable();
      $table->string('SD_email')
            ->nullable();
      $table->string('SD_phone')
            ->nullable();
      $table->boolean('SD_complete')
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
    Schema::dropIfExists('sale_documents');
  }
}
