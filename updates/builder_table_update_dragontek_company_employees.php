<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Employee;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyEmployees extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_employees', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Employee::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_employees', function ($table) {
            $table->dropColumn('slug');
        });
    }
}