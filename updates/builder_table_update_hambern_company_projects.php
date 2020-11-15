<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Project;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyProjects extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_projects', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Project::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_projects', function ($table) {
            $table->dropColumn('slug');
        });
    }
}