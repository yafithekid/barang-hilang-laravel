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
		if ($validation->fails()){
			return Redirect::back()->withInput(Input::except('password','repeat_password','image'))->withErrors($validation);
		} else {
			$user = new User(Input::all());
			$user->password = sha1($user->password);
			$user->save();
			if (Input::hasFile('image')){
				$image = Input::file('image');
				$extension = $image->getClientOriginalExtension();
				$image->move(User::imagePath(),"$user->id.".$extension);
				$user->image_filename = "$user->id.$extension";
				$user->save();
			}
			Session::flash('global-success','Registerasi berhasil. Silakan login dengan username dan password anda');
			return Redirect::route('home');
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

	public function getForgotPassword(){
		return View::make('home.forgot-password');
	}	

	public function postForgotPassword(){
		//TO DO HERE
		$email = Input::get('email');
		Session::flash('global-success','Silakan cek email anda');	
		return Redirect::home();
	}
}
