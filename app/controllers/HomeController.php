<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getHome()
	{
		//return __NAMESPACE__;
		return View::make('hello');
	}

	//show the register home page
	public function getRegister()
	{
		return View::make('home.register',['user'=>new User]);
	}

	/**
	 * Do the validation and data saving, redirect to show register when fail.
	 */
	public function postRegister()
	{
		$validation = Validator::make(Input::all(), User::$rules);
		if ($validation->fails()){
			return Redirect::back()->withInput(Input::except('password','repeat_password'))->withErrors($validation);
		} else {
			$user = new User;
			$user->username = Input::get('username');
			$user->password = sha1(Input::get('password'));
			$user->fullname = Input::get('fullname');
			$user->save();
			return Redirect::action('HomeController@getHome');
		}
	}

	public function postLogin()
	{
		$username = Input::get('username');
		$password = sha1(Input::get('password'));
		if (User::where('username','=',$username)->andWhere('password','=',$password)->get() !== null){
			Auth::login($username,true);
		} else {
			return Redirect::back();
		}
	}

}
