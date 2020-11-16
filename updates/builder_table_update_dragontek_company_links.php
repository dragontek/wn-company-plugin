<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Link;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyLinks extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_links', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Link::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_links', function ($table) {
            $table->dropColumn('slug');
        });
    }
}