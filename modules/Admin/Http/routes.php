<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function(){


	Route::get( '/login',	  [ 'as' => 'admin.login.get', 	 'uses' => 'AuthController@getLogin']);
	Route::post( '/login',	  [ 'as' => 'admin.login.post',  'uses' => 'AuthController@postLogin']);
	Route::get( '/logout',	  [ 'as' => 'admin.logout.get',  'uses' => 'AuthController@getLogout']);

	Route::group(['middleware' => 'admin'], function(){

		Route::get('/', 	[ 'as' => 'admin.home.get', 'uses' => 'AdminController@index' ]);

		/*
        * Posts
        */
		Route::group(['prefix' => 'posts'], function() {
			Route::get( '/',					[ 'as' => 'admin.posts.get', 					'uses' => 'PostController@getPosts'  	  				]);
			Route::get( '/add-new',				[ 'as' => 'admin.posts.add.get' , 				'uses' => 'PostController@getAddPost'   				]);
			Route::post( '/add-new',			[ 'as' => 'admin.posts.add.post', 				'uses' => 'PostController@postAddPost'  				]);
			Route::get( '/add-new/{id}',		[ 'as' => 'admin.posts.addTranslate.get', 		'uses' => 'PostController@getAddPostTranslate'  		]);
			Route::post( '/add-new/{id}',		[ 'as' => 'admin.posts.addTranslate.post', 		'uses' => 'PostController@postAddPostTranslate' 		]);
			Route::get( '/edit/{id}',			[ 'as' => 'admin.posts.edit.get', 				'uses' => 'PostController@getEditPost'  				]);
			Route::post( '/edit/{id}',			[ 'as' => 'admin.posts.edit.post', 				'uses' => 'PostController@postEditPost' 				]);
			Route::get( '/delete/{id}',			[ 'as' => 'admin.posts.delete.get'  , 			'uses' => 'PostController@getDeletePost'				]);
			Route::post( '/delete/{id}',		[ 'as' => 'admin.posts.delete.post'  , 			'uses' => 'PostController@postDeletePost' 				]);
			Route::get('/draft', 				[ 'as' => 'admin.posts.draft.get', 				'uses' => 'PostController@getPostsDraft'				]);
			Route::get('/trash',				[ 'as' => 'admin.posts.trash.get', 				'uses' => 'PostController@getPostsTrash'				]);
			Route::get( '/data',				[ 'as' => 'admin.posts.data.get' , 				'uses' => 'PostController@getPostsData' 				]);
		});


		/*
		* Users
		*/
		Route::group(['prefix' => 'users'], function() {
			Route::get( '/',					[ 'as' => 'admin.users.get', 					'uses' => 'UserController@getUsers'    					]);
			Route::get( '/add-new',				[ 'as' => 'admin.users.add.get', 				'uses' => 'UserController@getAddUser'   				]);
			Route::post( '/add-new',			[ 'as' => 'admin.users.add.post', 				'uses' => 'UserController@postAddUser'  				]);
			Route::get( '/edit/{id}',			[ 'as' => 'admin.users.edit.get', 				'uses' => 'UserController@getEditUser'  				]);
			Route::post( '/edit/{id}',			[ 'as' => 'admin.users.edit.post', 				'uses' => 'UserController@postEditUser' 				]);
			Route::get( '/delete/{id}',			[ 'as' => 'admin.users.delete.get', 			'uses' => 'UserController@getDeleteUser'  				]);
			Route::post( '/delete/{id}',		[ 'as' => 'admin.users.delete.post',			'uses' => 'UserController@postDeleteUser'  				]);
			Route::get( '/data',				[ 'as' => 'admin.users.data.get', 				'uses' => 'UserController@getUserData'      				]);
		});



		/*
		* Media
		*/
		Route::group(['prefix' => 'media'], function() {
			Route::get( '/',					[ 'as' => 'admin.media.get', 					'uses' => 'MediaController@getMedia'     				]);
			Route::get( '/add-new',				[ 'as' => 'admin.media.add.get', 				'uses' => 'MediaController@getAddMedia'   				]);
			Route::post( '/add-new',			[ 'as' => 'admin.media.add.post', 				'uses' => 'MediaController@postAddMedia'   				]);
			Route::get( '/edit/{id}',			[ 'as' => 'admin.media.edit.get', 				'uses' => 'MediaController@getEditMedia'   				]);
			Route::post( '/edit/{id}',			[ 'as' => 'admin.media.edit.post', 				'uses' => 'MediaController@postEditMedia'   			]);
			Route::get( '/data',				[ 'as' => 'admin.media.data.get', 				'uses' => 'MediaController@getMediaData' 				]);
			// Route::get( '/delete/{id}',			[ 'as' => 'admin.media.delete.get', 		'uses' => 'MediaController@getDeleteMedia'  	    ]);
			Route::post( '/delete/{id}',		[ 'as' => 'admin.media.delete.post', 			'uses' => 'MediaController@postDeleteMedia'  		]);
			Route::post( '/getMediaAjaxById',   [ 'as' => 'admin.media.ajax.get', 			    'uses' => 'MediaController@getMediaAjaxById'  		]);
			Route::post( '/moreMedia',		    [ 'as' => 'admin.media.more.post', 		        'uses' => 'MediaController@getMoreMedia'  		    ]);
		});


		/*
		* Comments
		*/
		Route::group(['prefix' => 'comments'], function() {
			Route::get( '/',					[ 'as' => 'admin.comments.get', 			'uses' => 'CommentController@getComment'     	   ]);
			Route::get( '/data',				[ 'as' => 'admin.comments.data.get', 		'uses' => 'CommentController@getCommentData' 	   ]);
			Route::get( '/changeCommentStatus/{comment_id}', [ 'as' => 'admin.comments.statusChange.get', 'uses' => 'CommentController@ChangeCommentStatus' ]);
		
		});


		/*
		* Contact
		*/
		Route::group(['prefix' => 'contact'], function() {
			Route::get( '/',					[ 'as' => 'admin.contact.get', 					'uses' => 'ContactController@getContact'     			]);
			Route::get( '/add-new',				[ 'as' => 'admin.contact.add.get', 				'uses' => 'ContactController@getAddContact'   			]);
			Route::post( '/add-new',			[ 'as' => 'admin.contact.add.post', 			'uses' => 'ContactController@postAddContact'   			]);
			Route::get( '/edit/{id}',			[ 'as' => 'admin.contact.edit.get', 			'uses' => 'ContactController@getEditContact'   			]);
			Route::post( '/edit/{id}',			[ 'as' => 'admin.contact.edit.post', 			'uses' => 'ContactController@postEditContact'   		]);
			Route::get( '/data',				[ 'as' => 'admin.contact.data.get', 			'uses' => 'ContactController@getContactData' 			]);
			Route::get( '/delete/{id}',			[ 'as' => 'admin.contact.delete.get', 			'uses' => 'ContactController@getDeleteContact'  		]);
			Route::post( '/delete/{id}',		[ 'as' => 'admin.contact.delete.post', 			'uses' => 'ContactController@postDeleteContact'  		]);
		});


		/*
		* Categories
		*/
		Route::group(['prefix' => 'category'], function() {
			Route::get( '/',					[ 'as' => 'admin.category.get', 				'uses' => 'CategoryController@getAddCategory'     			]);
			Route::get( '/articles',			[ 'as' => 'admin.category.articles.get', 		'uses' => 'CategoryController@getCategoryArticles' 			]);
			Route::get( '/cases',				[ 'as' => 'admin.category.cases.get', 			'uses' => 'CategoryController@getCategoryCases' 			]);
			Route::get( '/downloads',			[ 'as' => 'admin.category.downloads.get', 		'uses' => 'CategoryController@getCategoryDownload' 		]);
			Route::get( '/add-new',				[ 'as' => 'admin.category.add.get', 			'uses' => 'CategoryController@getAddCategory'   		]);
			Route::post( '/add-new',			[ 'as' => 'admin.category.add.post', 			'uses' => 'CategoryController@postAddCategory'   		]);
			Route::get( '/edit/{id}',			[ 'as' => 'admin.category.edit.get', 			'uses' => 'CategoryController@getEditCategory'   		]);
			Route::post( '/edit/{id}',			[ 'as' => 'admin.category.edit.post', 			'uses' => 'CategoryController@postEditCategory'   		]);
			Route::get( '/data',				[ 'as' => 'admin.category.data.get', 			'uses' => 'CategoryController@getCategoryData' 			]);
			Route::get( '/delete/{id}',			[ 'as' => 'admin.category.delete.get', 			'uses' => 'CategoryController@getDeleteCategory'  		]);
			Route::post( '/delete/{id}',		[ 'as' => 'admin.category.delete.post', 		'uses' => 'CategoryController@postDeleteCategory'  		]);
		});
		/*
		 * Settings
		 */
		Route::group(['prefix' => 'settings'], function () {

			Route::get('/general', ['as' => 'admin.settings.general.get', 'uses' => 'SettingsController@getSettings']);
			Route::post('/general', ['as' => 'admin.settings.general.post', 'uses' => 'SettingsController@postSettings']);

			/*
			* Languages
			*/
			Route::group(['prefix' => 'languages'], function() {
				Route::get( '/',					[ 'as' => 'admin.languages.get', 				'uses' => 'LanguageController@getLanguage'     			]);
				Route::get( '/add-new',				[ 'as' => 'admin.languages.add.get', 			'uses' => 'LanguageController@getAddLanguage'   		]);
				Route::post( '/add-new',			[ 'as' => 'admin.languages.add.post', 			'uses' => 'LanguageController@postAddLanguage'   		]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.languages.edit.get', 			'uses' => 'LanguageController@getEditLanguage'   		]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.languages.edit.post', 			'uses' => 'LanguageController@postEditLanguage'   		]);
				Route::get( '/data',				[ 'as' => 'admin.languages.data.get', 			'uses' => 'LanguageController@getLanguageData' 			]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.languages.delete.get', 		'uses' => 'LanguageController@getDeleteLanguage'  		]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.languages.delete.post', 		'uses' => 'LanguageController@postDeleteLanguage'  		]);
				Route::get( '/lang/{lang}',			[ 'as' => 'admin.languages.change.get', 		'uses' => 'LanguageController@setLanguageSession'  		]);
			});


			/*
			* Permissions
			*/
			Route::group(['prefix' => 'permissions'], function() {
				Route::get( '/',					[ 'as' => 'admin.permissions.get', 				'uses' => 'PermissionController@getPermission'  	    ]);
				Route::get( '/add-new',				[ 'as' => 'admin.permissions.add.get', 			'uses' => 'PermissionController@getAddPermission'   	]);
				Route::post( '/add-new',			[ 'as' => 'admin.permissions.add.post', 		'uses' => 'PermissionController@postAddPermission'   	]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.permissions.edit.get', 		'uses' => 'PermissionController@getEditPermission'  	]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.permissions.edit.post', 		'uses' => 'PermissionController@postEditPermission'   	]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.permissions.delete.get',	 	'uses' => 'PermissionController@getDeletePermission'  	]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.permissions.delete.post', 		'uses' => 'PermissionController@postDeletePermission'  	]);
				Route::get( '/data',				[ 'as' => 'admin.permissions.data.get', 		'uses' => 'PermissionController@getPermissionData' 		]);
			});


			/*
            * Roles
            */
			Route::group(['prefix' => 'roles'], function() {
				Route::get( '/',					[ 'as' => 'admin.roles.get', 					'uses' => 'RoleController@getRole'     					]);
				Route::get( '/add-new',				[ 'as' => 'admin.roles.add.get', 				'uses' => 'RoleController@getAddRole'   				]);
				Route::post( '/add-new',			[ 'as' => 'admin.roles.add.post', 				'uses' => 'RoleController@postAddRole'   				]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.roles.edit.get', 				'uses' => 'RoleController@getEditRole'   				]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.roles.edit.post',	 			'uses' => 'RoleController@postEditRole'   				]);
				Route::get( '/data',				[ 'as' => 'admin.roles.data.get', 				'uses' => 'RoleController@getRoleData' 					]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.roles.delete.get', 			'uses' => 'RoleController@getDeleteRole'  				]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.roles.delete.post', 			'uses' => 'RoleController@postDeleteRole'  				]);

			});


			/*
            * Country
            */
			Route::group(['prefix' => 'location/country'], function() {
				Route::get( '/',					[ 'as' => 'admin.country.get', 					'uses' => 'CountryController@getCountry'   				]);
				Route::get( '/add-new',				[ 'as' => 'admin.country.add.get', 				'uses' => 'CountryController@getAddCountry'  			]);
				Route::post( '/add-new',			[ 'as' => 'admin.country.add.post', 			'uses' => 'CountryController@postAddCountry' 			]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.country.edit.get', 			'uses' => 'CountryController@getEditCountry' 			]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.country.edit.post', 			'uses' => 'CountryController@postEditCountry'			]);
				Route::get( '/data',				[ 'as' => 'admin.country.data.get', 			'uses' => 'CountryController@getCountryData' 			]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.country.delete.get', 			'uses' => 'CountryController@getDeleteCountry'  		]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.country.delete.post', 			'uses' => 'CountryController@postDeleteCountry'  		]);
			});


			/*
            * City
            */
			Route::group(['prefix' => 'location/city'], function() {
				Route::get( '/',					[ 'as' => 'admin.city.get', 					'uses' => 'CityController@getCity'    					]);
				Route::get( '/add-new',				[ 'as' => 'admin.city.add.get', 				'uses' => 'CityController@getAddCity'   				]);
				Route::post( '/add-new',			[ 'as' => 'admin.city.add.post', 				'uses' => 'CityController@postAddCity'  				]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.city.edit.get', 				'uses' => 'CityController@getEditCity' 					]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.city.edit.post', 				'uses' => 'CityController@postEditCity'					]);
				Route::get( '/data',				[ 'as' => 'admin.city.data.get', 				'uses' => 'CityController@getCityData' 					]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.city.delete.get', 				'uses' => 'CityController@getDeleteCity'  				]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.city.delete.post', 			'uses' => 'CityController@postDeleteCity'  				]);
				Route::post( '/getCityAjax',		[ 'as' => 'admin.city.ajax.get', 				'uses' => 'CityController@getCityAjax'  				]);
			});


			/*
            * Zone
            */
			Route::group(['prefix' => 'location/zone'], function() {
				Route::get( '/',					[ 'as' => 'admin.zone.get', 					'uses' => 'ZoneController@getZone'     					]);
				Route::get( '/add-new',				[ 'as' => 'admin.zone.add.get', 				'uses' => 'ZoneController@getAddZone'   				]);
				Route::post( '/add-new',			[ 'as' => 'admin.zone.add.post', 				'uses' => 'ZoneController@postAddZone'   				]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.zone.edit.get', 				'uses' => 'ZoneController@getEditZone' 					]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.zone.edit.post', 				'uses' => 'ZoneController@postEditZone'					]);
				Route::get( '/data',				[ 'as' => 'admin.zone.data.get', 				'uses' => 'ZoneController@getZoneData' 					]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.zone.delete.get', 				'uses' => 'ZoneController@getDeleteZone'  				]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.zone.delete.post', 			'uses' => 'ZoneController@postDeleteZone'  				]);
				Route::post( '/getZoneAjax',		[ 'as' => 'admin.zone.ajax.get', 				'uses' => 'ZoneController@getZoneAjax'     				]);
			});


			/*
            * Tags
            */
			Route::group(['prefix' => 'tags'], function() {
				Route::get( '/',					[ 'as' => 'admin.tags.get', 					'uses' => 'TagController@getAddTag'     					]);
				Route::get( '/add-new',				[ 'as' => 'admin.tags.add.get', 				'uses' => 'TagController@getAddTag'   					]);
				Route::post( '/add-new',			[ 'as' => 'admin.tags.add.post', 				'uses' => 'TagController@postAddTag'   					]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.tags.edit.get', 				'uses' => 'TagController@getEditTag'   					]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.tags.edit.post', 				'uses' => 'TagController@postEditTag'   				]);
				Route::get( '/data',				[ 'as' => 'admin.tags.data.get', 				'uses' => 'TagController@getTagData' 					]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.tags.delete.get', 				'uses' => 'TagController@getDeleteTag'  				]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.tags.delete.post', 			'uses' => 'TagController@postDeleteTag'  				]);
			});


			/*
            * Menus
            */
			Route::group(['prefix' => 'menus'], function() {
				Route::get( '/',					[ 'as' => 'admin.menus.get', 					'uses' => 'MenuController@getMenu'     					]);
				Route::get( '/add-new',				[ 'as' => 'admin.menus.add.get', 				'uses' => 'MenuController@getAddMenu'   				]);
				Route::post( '/add-new',			[ 'as' => 'admin.menus.add.post', 				'uses' => 'MenuController@postAddMenu'   				]);
				Route::get( '/edit/{id}',			[ 'as' => 'admin.menus.edit.get', 				'uses' => 'MenuController@getEditMenu'   				]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.menus.edit.post', 				'uses' => 'MenuController@postEditMenu'   				]);
				Route::get( '/data',				[ 'as' => 'admin.menus.data.get', 				'uses' => 'MenuController@getMenuData' 					]);
				Route::get( '/delete/{id}',			[ 'as' => 'admin.menus.delete.get', 			'uses' => 'MenuController@getDeleteMenu'  				]);
				Route::post( '/delete/{id}',		[ 'as' => 'admin.menus.delete.post', 			'uses' => 'MenuController@postDeleteMenu'  				]);
			});


			/*
            * Editor
            */
			Route::group(['prefix' => 'webinfo'], function() {
				Route::get( '/edit/{id}',			[ 'as' => 'admin.webinfo.edit.get', 				'uses' => 'WebInfoController@getEditWebInfo'   			]);
				Route::post( '/edit/{id}',			[ 'as' => 'admin.webinfo.edit.post', 			    'uses' => 'WebInfoController@postEditWebInfo'   			]);
				});

		});


	});
});