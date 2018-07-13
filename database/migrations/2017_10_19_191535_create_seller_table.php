<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sellers', function (Blueprint $table) {
      $table->increments('id');
      $table->date('SD_deed')
            ->nullable();
      $table->date('SD_water')
            ->nullable();
      $table->date('SD_predial')
            ->nullable();
      $table->date('SD_light')
            ->nullable();
      $table->date('SD_birth_certificate')
            ->nullable();
      $table->date('SD_ID')
            ->nullable();
      $table->string('SD_CURP')
            ->nullable();
      $table->string('SD_RFC')
            ->nullable();
      $table->date('SD_account_status')
            ->nullable();
      $table->string('SD_email')
            ->nullable();
      $table->string('SD_phone')
            ->nullable();
      $table->enum('SD_civil_status', [
          'Soltero',
          'Casado',
        ])
        ->default('Soltero');
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
    Schema::dropIfExists('sellers');
  }
}
