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

	//show the register home page
	public function getRegister()
	{
		return View::make('home.register',['user'=>new User]);
	}

	/**
	 * Do the validation and data saving
	 * if success redirect to show register when fail.
	 * if fail, redirect back with errors
	 */
	public function postRegister()
	{
		$validation = Validator::make(Input::all(),User::$rules);
		var_dump(Input::all());
		if ($validation->fails()){
			return Redirect::back()->withInput(Input::except('password','repeat_password'))->withErrors($validation);
		} else {
			$user = new User;
			$user->username = Input::get('username');
			$user->password = sha1(Input::get('password'));
			$user->fullname = Input::get('fullname');
			$user->save();
			Session::flash('global-success','Registerasi berhasil. Silakan login dengan username dan password anda');
			return Redirect::action('HomeController@getHome');
		}
	}

	public function getLogin()
	{
		return View::make('home.login');
	}

	/**
	 * Check whether the username and password found in database.
	 * if fail, add error username/password invalid
	 * if success, redirect to home
	 */
	public function postLogin()
	{
		$username = Input::get('username');
		$password = sha1(Input::get('password'));
		$user = User::where('username','=',$username)->where('password','=',$password)->first();
		if ($user !== null){
			Auth::login($user,Input::get('remember_me', false));
			return Redirect::action('ItemController@anyIndex');
		} else {
			Session::flash('login_error','Invalid username/password');
			return Redirect::back()->withInput(Input::except('password'));
		}
	}

	/**
	 * logout the user and redirect to home
	 */
	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}
}
