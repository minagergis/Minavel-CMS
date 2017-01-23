<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('post_type', 20)->default('post');
            $table->string('post_status', 20)->default('publish');
            $table->text('extra')->nullable();
            $table->string('comment_status', 20)->default('open');
            $table->integer('comment_count')->default(0);

            $table->integer('media_id')->unsigned()->nullable()->index();
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');

            $table->timestamps();
        });

        Schema::create('posts_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->text('post_title');
            $table->text('post_excerpt');
            $table->text('post_content');
            $table->string('slug')->unique();
            $table->integer('post_author')->unsigned()->nullable()->index();
            $table->foreign('post_author')->references('id')->on('users')->onDelete('set null');

            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->string('locale')->nullable()->index();
            $table->foreign('locale')->references('locale')->on('language')->onDelete('set null');

            $table->timestamps();
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('post_id')->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->unsignedInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');


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
        Schema::drop('posts');
        Schema::drop('posts_translations');
        Schema::drop('post_category');
    }
}
