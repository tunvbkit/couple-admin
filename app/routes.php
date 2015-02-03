<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array("prefix" => "admin"),function()
{

	// ****** Admin Login *****
	Route::filter("check_login", function(){
		if(!Session::has("admin"))
			return Redirect::to("admin/login");
	});

	Route::get("main",array("before"=>"check_login", "as"=>"main","uses"=>"AdminController@index"));
	
	Route::get("login",array("as"=>"login","uses"=>"AdminController@get_login"));

	Route::get("logout",array("as"=>"logout","uses"=>"AdminController@get_logout"));

	Route::post("login",array("as"=>"login","uses"=>"AdminController@post_login"));

	Route::get("vendors",array("as"=>"vendors","before"=>"check_login","uses"=>"VendorController@index"));
	Route::get("vendors/create",array("as"=>"add-vendor","before"=>"check_login",function(){
		return View::make('add-vendor');
	}));

	Route::post("vendors/create",array("as"=>"add-vendor","uses"=>"VendorController@store"));

	Route::get("vendors/{id}",array("as"=>"delete-vendor","before"=>"check_login","uses"=>"VendorController@destroy"));
	
	Route::post("vendors/delete-vendors",array("as"=>"delete-vendors","uses"=>"VendorController@delete_vendors"));

	Route::get("vendors/{id}/edit",array("as"=>"edit-vendor","before"=>"check_login","uses"=>"VendorController@edit"));

	Route::post("vendors/{id}",array("as"=>"update-vendor","uses"=>"VendorController@update"));

	Route::post("search",array("as"=>"search","uses"=>"VendorController@search"));

	Route::post("check-vendor",array("as"=>"check-vendor","uses"=>"VendorController@check_vendor"));

	Route::post("check-vendor-email",array("as"=>"check-vendor-email","uses"=>"VendorController@check_vendor_email"));

	Route::post("edit-check-vendor/{id}",array("as"=>"edit-check-vendor","uses"=>"VendorController@edit_check_vendor"));

	Route::post("edit-check-vendor-email/{id}",array("as"=>"edit-check-vendor-email","uses"=>"VendorController@edit_check_vendor_email"));
	
	Route::get("range",array("as"=>"range","before"=>"check_login","uses"=>"BudgetRangeController@index"));

	Route::get("range/create",array("as"=>"add-range","before"=>"check_login","uses"=>"BudgetRangeController@create"));

	Route::post("range/create",array("as"=>"add-range","before"=>"check_login","uses"=>"BudgetRangeController@store"));
	
	Route::get("range/{id}",array("as"=>"delete-range","before"=>"check_login","uses"=>"BudgetRangeController@destroy"));

	Route::post("range/delete-ranges",array("as"=>"delete-ranges","before"=>"check_login","uses"=>"BudgetRangeController@delete_ranges"));
	
	Route::get("range/{id}/edit",array("as"=>"edit-range","before"=>"check_login","uses"=>"BudgetRangeController@edit"));

	Route::post("range/{id}",array("as"=>"update-range","before"=>"check_login","uses"=>"BudgetRangeController@update"));
	

	// ******* Category *****
	Route::get('categories', array("before"=>"check_login",'as' => 'categories', 'uses'=>'CategoriesController@ListCategory' ));

	Route::get('category/{id}/edit', array('uses'=>'CategoriesController@edit'));

	Route::get('category/add', array('as'=>'category/add','uses'=>'CategoriesController@AddCategory'));

	Route::post('NewCategory', array('uses'=>'CategoriesController@NewCategory'));

	Route::post('UpdateCategory', array('uses'=>'CategoriesController@UpdateCategory'));
	
	Route::post('check_category/{id}', array('uses'=>'CategoriesController@check_category'));

	Route::post('check_Categories', array('as' => 'check_Categories','uses'=>'CategoriesController@check_Categories'));
	
	Route::get('category/{id}/delete', array('uses'=>'CategoriesController@DeleteCategory'));

	Route::post('dels_category',array("as"=>"dels_category", "uses"=>"CategoriesController@dels_category"));

	Route::post("category/search",array("as"=>"search_category","uses"=>"CategoriesController@search"));
	
	
	// **** Location *******
	Route::get("location", array("before"=>"check_login","as"=>"location","uses"=>"LocationController@listLocation"));
	
	Route::get("location/add-location", array("as"=>"location/add-location","uses"=>"LocationController@showAdd"));
	
	Route::get("location/edit-location", array("as"=>"location/edit-location","uses"=>"LocationController@showEdit"));
	
	Route::post("location/add", array( "uses"=>"LocationController@addLocation"));
	
	Route::get("location/edit-location/{id}", array( "uses"=>"LocationController@editLocation"));
	
	Route::post("location/update/{id}", array("as"=>"update","uses"=>"LocationController@updateLocation"));
	
	Route::get("location/delete/{id}",array("uses"=>"LocationController@deleteLocation"));
	
	Route::post('delSelect',array("as"=>"'delSelect", "uses"=>"LocationController@delSelect"));
	Route::post("check-location",array("as"=>"check-location","uses"=>"LocationController@check_location"));	
	Route::post("edit-check-location/{id}",array("as"=>"edit-check-location","uses"=>"LocationController@edit_check_location"));

	Route::post("location/search",array("as"=>"search_location","uses"=>"LocationController@search"));

	
	//********* User ********
	Route::post("users/search",array("as"=>"SearchUser","uses"=>"AdminController@postSearchUser"));

	Route::get("users",array("before"=>"check_login","as"=>"users","uses"=>"AdminController@get_users"));
	// ---add user
	Route::post("users", array("as"=>"users","uses"=>"AdminController@post_users"));
	
	Route::post('check_email', array("as"=>"check_email", "uses"=>"AdminController@check_email"));
	Route::post('check_email_edit/{id}', array("as"=>"check_email_edit", "uses"=>"AdminController@check_email_edit"));

	// ----delete user
	Route::get("users/delete/{id}", array("as"=>"users/delete","uses"=>"AdminController@del_users"))
				->where(array('id'=>'[0-9]+'));
	Route::post('dels',array("as"=>"dels", "uses"=>"AdminController@dels"));

	// -----edit user
	Route::get("users/edit/{id}", array("as"=>"users/edit","uses"=>"AdminController@get_edit_users"))
				->where(array('id'=>'[0-9]+'));
	Route::post("users/edit/{id}", array("as"=>"users/edit","uses"=>"AdminController@post_edit_users"))
				->where(array('id'=>'[0-9]+'));

	
	/*****Task*****/
	Route::get('task',array('before'=>'check_login','as'=>'task','uses'=>"TaskController@showTask"));
	Route::get('task/add-task',array('as'=>'task/add-task','uses'=>'TaskController@showAdd'));
	Route::post('task/add', array('as'=>"task/add", 'uses'=>'TaskController@addTask'));
	Route::get('task/edit-task',array('as'=>'task/edit-task','uses'=>'TaskController@showEdit'));
	Route::post('checkTitle',array('as'=>'checkTitle','uses'=>'TaskController@checkTitle'));
	Route::post('edit_checkTitle/{id}',array('as'=>'edit_checkTitle','uses'=>'TaskController@edit_checkTitle'));
	Route::get('task/edit/{id}',array('as'=>'task/edit', 'uses'=>'TaskController@editTask'));
	Route::post('task/update/{id}', array('as'=>'task/update','uses'=>'TaskController@updateTask'));
	Route::get('task/delete/{id}', array('as'=>'task/delete','uses'=>'TaskController@deleteTask'));
	Route::post('delSelectTask',array("as"=>"delSelectTask", "uses"=>"TaskController@delSelectTask"));
	Route::post('search-task',array('as'=>'search-task',"uses"=>"TaskController@searchTask"));
	Route::post('edit-check-task/{id}',array('as'=>'edit-check-task','uses'=>"TaskController@editCheckTask"));
	/****Item*****/
	Route::get('item',array('before'=>'check_login','as'=>'item','uses'=>'ItemController@show'));
	Route::post('item/delete',array('as'=>'deleteItem','uses'=>'ItemController@deleteItem'));
	Route::post('item/add',array('as'=>'add','uses'=>'ItemController@addItem'));
	Route::post('item/updateItem',array('as'=>'updateItem','uses'=>'ItemController@updateItem'));
	Route::post('item/updateRange1',array('as'=>'updateRange1','uses'=>'ItemController@updateRange1'));
	Route::post('item/updateRange2',array('as'=>'updateRange2','uses'=>'ItemController@updateRange2'));
	Route::post('item/updateRange3',array('as'=>'updateRange3','uses'=>'ItemController@updateRange3'));
	Route::post('item/updateRange4',array('as'=>'updateRange4','uses'=>'ItemController@updateRange4'));
	Route::post('item/updateRange5',array('as'=>'updateRange5','uses'=>'ItemController@updateRange5'));
	Route::post('item/updateCate1',array('as'=>'updateCate1','uses'=>'CategoriesController@updateCate1'));
	Route::post('item/updateCate2',array('as'=>'updateCate2','uses'=>'CategoriesController@updateCate2'));
	Route::post('item/updateCate3',array('as'=>'updateCate3','uses'=>'CategoriesController@updateCate3'));
	Route::post('item/updateCate4',array('as'=>'updateCate4','uses'=>'CategoriesController@updateCate4'));
	Route::post('item/updateCate5',array('as'=>'updateCate5','uses'=>'CategoriesController@updateCate5'));

	// ***** Songs ******
	Route::get('songs', array('as'=>'songs', 'uses'=>'SongController@index'));

	Route::get('songs/comments', array('as'=>'song_comments', 'uses'=>'SongController@comments'));

	//----create song
	Route::post('songs', array('as'=>'songs', 'uses'=>'SongController@create'));

	Route::post('check_song_name', array('as'=>'check_song_name', 'uses'=>'SongController@check_song_name'));

	// ---delete one song
	Route::get('songs/delete/{id}', array('as'=>'songs/delete', 'uses'=>'SongController@destroy'));

	// ---delete many song
	Route::post('songs/delete', array('as'=>'song_dels', 'uses'=>'SongController@destroyMany'));

	// ----edit song
	Route::get('songs/{id}/edit', array('as'=>'songs-edit', 'uses'=>'SongController@edit'));

	Route::post('check_song_name_edit/{id}', array('as'=>'check_song_name_edit', 'uses'=>'SongController@check_song_name_edit'));
	
	Route::post('songs/edit', array('as'=>'songs/edit', 'uses'=>'SongController@update'));

	// *** Song-comment
	Route::get('song_comments', array('as'=>'song_comments', 'uses'=>'SongController@comments'));

	// delete comment song
	Route::post('song_cmt_dels', array('as'=>'song_cmt_dels', 'uses'=>'SongController@commentsDelete'));


	Route::post('search_song',array('as'=>'search_song','uses'=>'SongController@search'));

	
	//****Image-slide
	Route::get('imageslide',array('before'=>'check_login','as'=>'imageslide','uses'=>'ImageSlideController@showImageSlide'));
	Route::get('imageslide/add',array('as'=>'imageslide/add','uses'=>'ImageSlideController@showAdd'));
	Route::post('imageslide/add',array('as'=>'upload','uses'=>'ImageSlideController@post_addImage'));
	Route::get('imnageslide/edit/{id}',array('as'=>'edit','uses'=>'ImageSlideController@edit'));
	Route::get('imageslide/update',array('as'=>'imageslide/update', 'uses'=>'ImageSlideController@showUpdate'));
	Route::post('imageslide/update/{id}',array('as'=>'update','uses'=>'ImageSlideController@update'));
	Route::post('imageslide/delete/',array('as'=>'imageslide/delete','uses'=>'ImageSlideController@delete'));
	Route::post('delSelectImages',array('as'=>'delSelectImages','uses'=>'ImageSlideController@delSelectImages'));
	Route::post('check_imageslide',array('as'=>'check_imageslide','uses'=>'ImageSlideController@checkImageSlide'));
	Route::post('sent_id_image',array('as'=>'sent_id_image','uses'=>'ImageSlideController@sentIdImage'));
	Route::post('search_image',array('as'=>'search_image','uses'=>'ImageSlideController@search'));
});

