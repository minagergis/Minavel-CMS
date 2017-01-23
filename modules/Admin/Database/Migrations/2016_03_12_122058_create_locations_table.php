<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code', 5)->unique();
            $table->string('code2', 5)->unique();
            $table->string('status')->default('active');
            $table->string('continent')->nullable();
            $table->timestamps();
        }); 
        Schema::create('country_translations', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            
            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
            
            $table->string('locale')->nullable()->index();
            $table->foreign('locale')->references('locale')->on('language')->onDelete('set null');  
            $table->unique(['country_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('city', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('status')->default('active');

            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');

            $table->timestamps();
        }); 
        Schema::create('city_translations', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');

            $table->string('locale')->nullable()->index();
            $table->foreign('locale')->references('locale')->on('language')->onDelete('set null');  
            $table->unique(['city_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('zone', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('status')->default('active');

            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');

            $table->timestamps();
        }); 
        Schema::create('zone_translations', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            
            $table->unsignedInteger('zone_id');
            $table->foreign('zone_id')->references('id')->on('zone')->onDelete('cascade');

            $table->string('locale')->nullable()->index();
            $table->foreign('locale')->references('locale')->on('language')->onDelete('set null');  
            $table->unique(['zone_id', 'locale']);
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
        Schema::drop('country');
        Schema::drop('country_translations');       
        Schema::drop('city');
        Schema::drop('city_translations');      
        Schema::drop('zone');
        Schema::drop('zone_translations');
    }
}