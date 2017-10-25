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
      $table->date('predial')
            ->nullable();
      $table->date('light')
            ->nullable();
      $table->date('water')
            ->nullable();
      $table->date('deed')
            ->nullable();
      $table->date('generals_sheet')
            ->nullable();
      $table->date('INE')
            ->nullable();
      $table->date('CURP')
            ->nullable();
      $table->enum('civil_status', [
          'Soltero',
          'Casado',
        ])
        ->default('Soltero');
      $table->date('birth_certificate')
            ->nullable();
      $table->date('account_status')
            ->nullable();
      $table->string('email')
            ->nullable();
      $table->string('phone')
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
    Schema::dropIfExists('sale_documents');
  }
}
