<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('title');
            $table->text('desc');
            $table->text('tags');
            $table->string('locale');
            $table->integer('item_id');
            $table->text('item_type');

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
        Schema::drop('seo');
    }

}
