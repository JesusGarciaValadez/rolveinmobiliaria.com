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
      $table->date('generals_sheet');
      $table->date('INE');
      $table->date('CURP');
      $table->enum('civil_status', [
          'Soltero',
          'Casado',
        ]);
      $table->date('birth_certificate');
      $table->date('account_status');
      $table->string('email');
      $table->string('phone');
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
