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
      $table->date('SL_date')
            ->nullable();
      $table->string('SL_subject')
            ->nullable();
      $table->text('SL_log_observations')
            ->nullable();
      $table->text('SL_email')
            ->nullable();
      $table->text('SL_phone')
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
