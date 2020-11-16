<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Gallery;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyGalleries extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_galleries', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Gallery::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_galleries', function ($table) {
            $table->dropColumn('slug');
        });
    }
}