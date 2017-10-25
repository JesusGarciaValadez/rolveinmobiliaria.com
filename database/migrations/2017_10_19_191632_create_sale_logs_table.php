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
      $table->date('date')
            ->nullable();
      $table->string('subject')
            ->nullable();
      $table->text('log_observations')
            ->nullable();
      $table->text('email')
            ->nullable();
      $table->text('phone')
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
    Schema::dropIfExists('sale_logs');
  }
}
