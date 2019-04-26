<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//index
Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('index');
Route::get('/contract', 'HomeController@contract')->name('contract');
Route::get('/feature', 'HomeController@feature')->name('feature');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/about-us', 'HomeController@aboutus')->name('aboutus');

Route::group(['prefix'=>'admin','middleware'=>'isadmin'],function(){
	//admin
	Route::get('/', 'HomeController@admin')->name('admin');

	//posts
	Route::get('/get-list-post', 'PostController@getList')->name('posts.getList');
	Route::group(['prefix'=>'post'],function(){
		Route::get('/', 'PostController@index')->name('posts.index');
		
		Route::get('/create', 'PostController@create')->name('posts.create');
		Route::post('/','PostController@store')->name('posts.store');
		Route::get('/{id}','PostController@show')->name('posts.show');
		Route::get('/{id}/edit', 'PostController@edit')->name('posts.edit');
		Route::post('/{id}', 'PostController@update')->name('posts.update');
		Route::delete('/{id}', 'PostController@destroy')->name('posts.destroy');
	});

	//tags
	Route::get('/get-list-tag', 'TagController@getList')->name('tags.getList');
	Route::group(['prefix'=>'tag'],function(){
		Route::get('/', 'TagController@index')->name('tags.index');
		
		Route::get('/create', 'TagController@create')->name('tags.create');
		Route::post('/','TagController@store')->name('tags.store');
		Route::get('/{id}','TagController@show')->name('tags.show');
		Route::get('/{id}/edit', 'TagController@edit')->name('tags.edit');
		Route::put('/{id}', 'TagController@update')->name('tags.update');
		Route::delete('/{id}', 'TagController@destroy')->name('tags.destroy');
	});

	//categories
	Route::get('/get-list-category', 'CategoriesController@getList')->name('categories.getList');
	Route::group(['prefix'=>'category'],function(){
		Route::get('/', 'CategoriesController@index')->name('categories.index');
		
		Route::get('/create', 'CategoriesController@create')->name('categories.create');
		Route::post('/','CategoriesController@store')->name('categories.store');
		Route::get('/{id}','CategoriesController@show')->name('categories.show');
		Route::get('/{id}/edit', 'CategoriesController@edit')->name('categories.edit');
		Route::put('/{id}', 'CategoriesController@update')->name('categories.update');
		Route::delete('/{id}', 'CategoriesController@destroy')->name('categories.destroy');
	});

	//user
	Route::get('/get-list-user', 'UserController@getList')->name('users.getList');
	Route::group(['prefix'=>'user'],function(){
		Route::get('/', 'UserController@index')->name('users.index');
		
		Route::get('/{id}','UserController@show')->name('users.show');
		Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
		Route::put('/{id}', 'UserController@update')->name('users.update');
		Route::delete('/{id}', 'UserController@destroy')->name('users.destroy');
	});

	//posttag
	Route::get('/get-list-posttag', 'PostTagsController@getList')->name('posttags.getList');
	Route::group(['prefix'=>'posttag'],function(){
		Route::get('/', 'PostTagsController@index')->name('posttags.index');
		
		Route::post('/','PostTagsController@store')->name('posttags.store');
		Route::get('/{id}','PostTagsController@show')->name('posttags.show');
		Route::get('/{id}/edit', 'PostTagsController@edit')->name('posttags.edit');
		Route::put('/{id}', 'PostTagsController@update')->name('posttags.update');
		Route::delete('/{id}', 'PostTagsController@destroy')->name('posttags.destroy');
	});
});