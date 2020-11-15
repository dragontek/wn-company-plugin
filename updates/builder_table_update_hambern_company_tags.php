<?php namespace Dragontek\Company\Updates;

use Dragontek\Company\Models\Tag;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDragontekCompanyTags extends Migration
{
    public function up()
    {
        Schema::table('dragontek_company_tags', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Tag::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_tags', function ($table) {
            $table->dropColumn('slug');
        });
    }
}