<?php

    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect']
        ],
        function () {


            //Route::auth();

            //Route::get('/home', 'HomeController@index');


            Route::get( '/login',	  [ 'as' => 'frontend.login.get', 	 'uses' => 'Auth\AuthController@getLogin']);
            Route::post( '/login',	  [ 'as' => 'frontend.login.post',  'uses' => 'Auth\AuthController@postLogin']);
            Route::get( '/logout',	  [ 'as' => 'frontend.logout.get',  'uses' => 'Auth\AuthController@getLogout']);


            Route::get( '/'        , [ 'as' => 'frontend.home.get'    , 'uses' => 'PageController@getHome'    ]);
            Route::get( '/about'   , [ 'as' => 'frontend.about.get'   , 'uses' => 'PageController@getAbout'   ]);
            Route::get( '/gallery' , [ 'as' => 'frontend.gallery.get' , 'uses' => 'PageController@getGallery' ]);
            Route::get( '/instructors' , [ 'as' => 'frontend.instructors.get' , 'uses' => 'PageController@getInstructors' ]);
            Route::get( '/contact' , [ 'as' => 'frontend.contact.get' , 'uses' => 'ContactController@getContact' ]);
            Route::post( '/contact' , [ 'as' => 'frontend.contact.post' , 'uses' => 'ContactController@postContact' ]);

            Route::get( '/blog'    , [ 'as' => 'frontend.blog.get' , 'uses' => 'BlogController@getBlog' ]);
            Route::get( '/blog/{id}'    , [ 'as' => 'frontend.blog.single.get' , 'uses' => 'BlogController@getSingleBlog' ]);
            
        });
