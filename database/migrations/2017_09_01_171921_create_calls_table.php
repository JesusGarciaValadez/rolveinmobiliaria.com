<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('calls', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('type_of_operation', [
              \App\Enums\OperationType::SALES,
              \App\Enums\OperationType::RENT,
              \App\Enums\OperationType::EXCLUSIVE_CONTRACTS,
              \App\Enums\OperationType::LEGAL,
              \App\Enums\OperationType::APPRAISALS,
            ])
            ->default(\App\Enums\OperationType::SALES);
      $table->string('address')
            ->nullable();
      $table->integer('user_id')
            ->unsigned()
            ->nullable();
      $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
      $table->text('observations')
            ->nullable();
      $table->text('status')
            ->nullable();
      $table->enum('priority', [
              \App\Enums\PriorityType::LOW,
              \App\Enums\PriorityType::MEDIUM,
              \App\Enums\PriorityType::HIGH,
            ])
            ->default(\App\Enums\PriorityType::MEDIUM);
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
    Schema::table('calls', function (Blueprint $table) {
      $table->dropForeign('calls_user_id_foreign')
            ->dropColumn('user_id');
    });

    Schema::dropIfExists('calls');
  }
}
