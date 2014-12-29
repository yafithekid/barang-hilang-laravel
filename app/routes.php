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

Route::group(['prefix' => '/item'],function(){
	Route::get('/create',['uses' =>'ItemController@getCreate']);
	Route::post('/create',['uses' => 'ItemController@postCreate']);
	Route::any('/index',['uses' => 'ItemController@getIndex']);
	Route::any('/search',['uses' => 'ItemController@getSearch']);
	Route::any('/{id}/view',['uses' => 'ItemController@anyView']);
	Route::post('/{id}/add-comment',['uses' => 'ItemController@postComment']);
});

Route::get('/register',['uses' => 'HomeController@getRegister']);
Route::post('/register',['uses' => 'HomeController@postRegister']);
Route::post('/login',['uses' => 'HomeController@postLogin']);
Route::get('/logout',['uses' => 'HomeController@getLogout']);
Route::get('/',['uses'=>'HomeController@getHome']);
//Route::get('home',['uses' => 'HomeController@showWelcome']);
