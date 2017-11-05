<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('calls', function (Blueprint $table) {
        $table->integer('state_id')
              ->unsigned()
              ->nullable()
              ->default('7')
              ->after('address');
        $table->foreign('state_id')
              ->references('id')
              ->on('states')
              ->onUpdate('cascade')
              ->onDelete('set null');

        $table->integer('client_id')
              ->unsigned()
              ->nullable()
              ->after('type_of_operation');
        $table->foreign('client_id')
              ->references('id')
              ->on('clients')
              ->onUpdate('cascade')
              ->onDelete('cascade');
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
        $table->dropForeign('calls_state_id_foreign')
              ->dropColumn('state_id');

        $table->dropForeign('calls_client_id_foreign')
              ->dropColumn('client_id');
      });
    }
}
