<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password', 60);
            
            $table->string('job')->nullable();
            $table->string('mobile')->nullable();
            $table->string('age')->nullable();
            $table->text('about')->nullable();
            $table->string('url')->nullable();
            $table->string('address')->nullable();

            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');

            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');

            $table->string('type')->default('user');

            $table->text('dimensions');
            
            $table->enum('status', [0, 1])->default(0);
            $table->string('confirmation_code')->nullable();

            $table->rememberToken();
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
        Schema::drop('users');
    }

}
