<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class AlterInternalExpedientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('internal_expedients', function (Blueprint $table) {
        Carbon::setLocale('mx');
        Carbon::setUtf8(true);
        $date = Carbon::now();

        $table->enum('expedient_key', [
                'VNT',
                'RNT',
                'CEX',
                'JRD',
                'AVA'
              ])
              ->default('VNT')
              ->charset('utf8')
              ->collation('utf8_unicode_ci')
              ->after('user_id');
        $table->string('expedient_year', 4)
              ->default($date->formatLocalized('%y'))
              ->charset('utf8')
              ->collation('utf8_unicode_ci')
              ->after('expedient');
        $table->renameColumn('expedient', 'expedient_number');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('internal_expedients', function (Blueprint $table) {
        $table->dropColumn('expedient_year')
              ->dropColumn('expedient_key')
              ->renameColumn('expedient_number', 'expedient');
      });
    }
}
