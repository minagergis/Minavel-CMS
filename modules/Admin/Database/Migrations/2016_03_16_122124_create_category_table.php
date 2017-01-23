<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->Integer('media')->nullable();
            $table->Integer('parent')->nullable();
            $table->timestamps();
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->string('slug');
            $table->text('description');

            $table->unsignedInteger('author')->nullable()->index();
            $table->foreign('author')->references('id')->on('users')->onDelete('set null');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');

            $table->string('locale')->nullable()->index();
            $table->foreign('locale')->references('locale')->on('language')->onDelete('set null');

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
        Schema::drop('category');
        Schema::drop('category_translations');
    }
}
