<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleSignaturesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_signatures', function (Blueprint $table) {
      $table->increments('id');
      $table->date('writing_review')
            ->nullable();
      $table->date('scheduled_date_of_writing_signature')
            ->nullable();
      $table->date('writing_signature')
            ->nullable();
      $table->date('scheduled_payment_date')
            ->nullable();
      $table->date('payment_made')
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
    Schema::dropIfExists('sale_signatures');
  }
}
