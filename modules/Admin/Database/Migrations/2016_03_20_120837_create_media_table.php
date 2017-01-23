<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'media', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('guid');
            $table->string('type');
            $table->string('name');
            $table->string('mime_type');
            $table->text('meta');
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
        Schema::drop('media');
    }

}