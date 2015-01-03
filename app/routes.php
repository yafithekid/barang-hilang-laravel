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

Route::pattern('id','[0-9]+');
Route::filter('auth.login', function(){
	if (Auth::guest()){
		Session::flash('global-error','Anda harus login terlebih dahulu');
		return Redirect::route('login');
	}
});

Route::group(['prefix' => '/item'],function(){
	Route::group(['before' => 'auth.login'], function(){
		Route::get('/create',['uses' =>'ItemController@getCreate']);
		Route::post('/create',['uses' => 'ItemController@postCreate']);
		Route::post('/{id}/add-comment',['uses' => 'ItemController@postComment']);
		Route::any('/mine',['uses' => 'ItemController@anyMine' ,'as' => 'item.mine']);
		Route::get('/{id}/update',['uses'=>'ItemController@getUpdate']);
		Route::post('/{id}/update',['uses'=>'ItemController@postUpdate']);
		Route::any('/{id}/delete',['uses'=>'ItemController@anyDelete']);
		Route::any('/{id}/hidden',['uses'=>'ItemController@anyHidden']);
		Route::any('/{id}/change-status',['uses' => 'ItemController@anyStatus']);
	});
	
	Route::any('/advanced-search',['uses'=>'ItemController@anyAdvancedSearch']);
	Route::any('/index',['uses' => 'ItemController@anyIndex']);
	
	Route::any('/search',['uses' => 'ItemController@anySearch']);
	Route::any('/category/{id}-{name}',['uses' => 'ItemController@anyCategory']);

	Route::any('/{id}/view',['uses' => 'ItemController@anyView']);
	
});

Route::group(['prefix' => '/user'],function(){
	Route::group(['before' => 'auth-login'],function(){
		Route::get('/{id}/update',['uses' => 'UserController@getUpdate']);
		Route::post('/{id}/update',['uses' => 'UserController@postUpdate']);
	});
});

Route::get('/register',['as'=>'register','uses' => 'HomeController@getRegister']);
Route::post('/register',['uses' => 'HomeController@postRegister']);
Route::post('/login',['as'=>'login','uses' => 'HomeController@postLogin']);
Route::get('/login', ['uses' => 'HomeController@getLogin']);
Route::get('/forgot-password',['uses'=>'HomeController@getForgotPassword']);
Route::post('/forgot-password',['uses' => 'HomeController@postForgotPassword']);

Route::get('/logout',['uses' => 'HomeController@getLogout']);
Route::get('/',['as'=>'home','uses'=>'ItemController@anyIndex']);
//Route::get('home',['uses' => 'HomeController@showWelcome']);
