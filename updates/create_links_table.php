<?php namespace Dragontek\Company\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateLinksTable extends Migration
{

    public function up()
    {
        Schema::create('dragontek_company_links', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->string('url');
            $table->text('description');
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
        Schema::table('dragontek_company_pivots', function ($table) {
            $table->integer('link_id')->unsigned()->nullable()->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dragontek_company_links');

        if (Schema::hasColumn('dragontek_company_pivots', 'link_id')) {
            Schema::table('dragontek_company_pivots', function ($table) {
                $table->dropColumn('link_id');
            });
        }
    }

}
