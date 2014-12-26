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

Route::group(['prefix'=>'/'], function()
{
	Route::get('register',['uses' => 'HomeController@getRegister']);
	Route::post('register',['uses' => 'HomeController@postRegister']);
	Route::get('home',['uses' => 'HomeController@getHome']);
	Route::post('login',['uses' => 'HomeController@postLogin']);

});
Route::get('home',['uses' => 'HomeController@showWelcome']);
