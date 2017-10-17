<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDocumentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sales_documents', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('internal_expedients_id')
            ->unsigned();
      $table->foreign('internal_expedients_id')
            ->references('id')
            ->on('internal_expedients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
      $table->string('predial')
            ->nullable();
      $table->string('light')
            ->nullable();
      $table->string('water')
            ->nullable();
      $table->string('deed')
            ->nullable();
      $table->string('generals_sheet');
      $table->string('INE');
      $table->string('CURP');
      $table->enum('civil_status', [
        'Soltero',
        'Casado',
      ]);
      $table->string('birth_certificate');
      $table->string('account_status');
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
    Schema::table('sales_documents', function (Blueprint $table) {
      $table->dropForeign('sales_documents_internal_expedients_id_foreign')
            ->dropColumn('internal_expedients_id');
    });

    Schema::dropIfExists('sales_documents');
  }
}
