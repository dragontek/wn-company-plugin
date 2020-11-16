<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Role;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyRoles extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_roles', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Role::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_roles', function ($table) {
            $table->dropColumn('slug');
        });
    }
}