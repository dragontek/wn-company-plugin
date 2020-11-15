<?php namespace Dragontek\Company\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyServices extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('dragontek_company_services','link')) {
            Schema::table('dragontek_company_services', function ($table) {
                $table->string('link', 255)->nullable();
            });
        }        
    }

    public function down()
    {
        if (Schema::hasColumn('hambern_company_services','link')) {
            Schema::table('hambern_company_services', function ($table) {
                $table->dropColumn('link');
            });
        }        
    }
}
