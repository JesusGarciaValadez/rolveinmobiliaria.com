<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('clients', function (Blueprint $table)
      {
        $table->renameColumn('email', 'email_1');
        $table->string('email_2')
              ->after('email')
              ->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('clients', function (Blueprint $table)
      {
        $table->dropColumn('email_2');
        $table->renameColumn('email_1', 'email');
      });
    }
}
