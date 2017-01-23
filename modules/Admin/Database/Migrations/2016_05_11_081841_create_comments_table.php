<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('obj_id');
            $table->string('obj_type');

            $table->string('comment_author_IP');
            $table->enum('comment_approved', [0,1])->default(0);

            $table->text('comment_content');
            
            $table->Integer('comment_parent')->nullable();

            $table->integer('comment_author')->unsigned()->nullable()->index();
            $table->foreign('comment_author')->references('id')->on('users')->onDelete('set null');

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
        Schema::drop('comments');
    }
}
