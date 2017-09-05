<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
     Schema::table('users', function (Blueprint $table) {
       $table->integer('role_id')
             ->unsigned()
             ->nullable()
             ->after('password');
       $table->foreign('role_id')
             ->references('id')
             ->on('roles')
             ->onUpdate('cascade')
             ->onDelete('set null');
       $table->softDeletes()
             ->after('updated_at');
     });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
     Schema::table('users', function (Blueprint $table) {
       $table->dropForeign('users_role_id_foreign')
             ->dropColumn('role_id');
       $table->dropColumn('deleted_at');
     });
   }
}
