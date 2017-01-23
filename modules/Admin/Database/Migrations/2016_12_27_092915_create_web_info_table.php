<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebInfoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_info', function(Blueprint $table)
        {
            $table->increments('id');
            /* web info data*/
            $table->string('title');
            $table->text('desc');
            $table->text('tags');
            /*social media data*/
            $table->text('socials')->nullable();
            /*extras like : opentime & telephone*/
            $table->text('extras')->nullable();
            /*statistics for websites*/
            $table->text('stats')->nullable();

            $table->string('locale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('web_info');
    }

}
