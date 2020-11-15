<?php namespace Dragontek\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangePivotsTable20160918 extends Migration
{

    public function up()
    {
        Schema::table('dragontek_company_pivots', function ($table) {
            $table->integer('tag_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_pivots', function ($table) {
            $table->dropColumn('tag_id');
        });
    }
}
