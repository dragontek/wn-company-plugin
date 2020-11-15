<?php namespace Dragontek\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePivotsTable extends Migration
{

    public $models = [
        'employee',
        'gallery',
        'project',
        'role',
        'service',
        'testimonial',
    ];

    public function up()
    {
        Schema::create('dragontek_company_pivots', function ($table) {
            $table->engine = 'InnoDB';
            foreach ($this->models as $model) {
                $table->integer($model . '_id')->unsigned()->nullable()->index();
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('dragontek_company_pivots');
    }

}
