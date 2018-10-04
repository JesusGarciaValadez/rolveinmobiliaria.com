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
      $table->integer('SD_deed')
            ->nullable();
      $table->integer('SD_water')
            ->nullable();
      $table->integer('SD_predial')
            ->nullable();
      $table->integer('SD_light')
            ->nullable();
      $table->integer('SD_birth_certificate')
            ->nullable();
      $table->integer('SD_ID')
            ->nullable();
      $table->string('SD_CURP')
            ->nullable();
      $table->string('SD_RFC')
            ->nullable();
      $table->integer('SD_account_status')
            ->nullable();
      $table->string('SD_email')
            ->nullable();
      $table->string('SD_phone')
            ->nullable();
      $table->enum('SD_civil_status', [
          \App\Enums\CivilStatusType::SINGLE,
          \App\Enums\CivilStatusType::MARRIED,
        ])
        ->default(\App\Enums\CivilStatusType::SINGLE);
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
