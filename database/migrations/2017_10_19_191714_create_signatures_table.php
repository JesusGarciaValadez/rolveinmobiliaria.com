<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignaturesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('signatures', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('SS_writing_review')
            ->nullable();
      $table->integer('SS_scheduled_date_of_writing_signature')
            ->nullable();
      $table->integer('SS_writing_signature')
            ->nullable();
      $table->integer('SS_scheduled_payment_date')
            ->nullable();
      $table->integer('SS_payment_made')
            ->nullable();
      $table->boolean('SS_complete')
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
    Schema::dropIfExists('signatures');
  }
}
