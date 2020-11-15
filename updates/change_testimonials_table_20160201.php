<?php namespace Dragontek\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangeTestimonialsTable20160201 extends Migration
{

    public function up()
    {
        Schema::table('dragontek_company_testimonials', function ($table) {
            $table->text('content')->change();
        });
    }

    public function down()
    {
        Schema::table('dragontek_company_testimonials', function ($table) {
            $table->string('content')->change();
        });
    }

}
