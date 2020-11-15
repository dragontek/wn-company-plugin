<?php namespace Dragontek\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateRolesTable extends Migration
{

    public function up()
    {
        Schema::create('dragontek_company_roles', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dragontek_company_roles');
    }

}
