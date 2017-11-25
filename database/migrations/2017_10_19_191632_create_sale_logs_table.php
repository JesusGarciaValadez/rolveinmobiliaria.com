<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleLogsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_logs', function (Blueprint $table) {
      $table->increments('id');
      $table->string('SL_subject')
            ->nullable();
      $table->string('SL_email')
            ->nullable();
      $table->string('SL_phone')
            ->nullable();
      $table->text('SL_observations')
            ->nullable();
      $table->boolean('SL_complete')
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
    Schema::dropIfExists('sale_logs');
  }
}
