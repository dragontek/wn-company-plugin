<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Service;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyServices2 extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_services', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Service::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_services', function ($table) {
            $table->dropColumn('slug');
        });
    }
}