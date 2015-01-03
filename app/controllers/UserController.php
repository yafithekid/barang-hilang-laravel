<?php

class UserController extends BaseController {

	public function getUpdate($id){
		$user = User::findOrFail($id);
		$user->password = null;
		return View::make('user.update',['user' => $user]);
	}

	public function postUpdate($id){
		$user = User::findOrFail($id);
		$user->fill(Input::except('username','password'));
		if (Input::has('password')){
			$user->password = sha1(Input::get('password'));
		}
		$validator = Validator::make(Input::all(),User::$update_rules);
		if ($validator->fails()){
			$user->password = null;
			return View::make('user.update',[
				'user' => $user,
				'errors' => $validator->errors()
			]);
		} else {
			$user->save();
			if (Input::hasFile('image')){
				$image = Input::file('image');
				$extension = $image->getClientOriginalExtension();
				$image->move(User::imagePath(),"$user->id.".$extension);
				$user->image_filename = "$user->id.$extension";
				$user->save();
			}
			$user->password = null;
			Session::flash('global-success','Data berhasil diubah');
			header("Cache-Control: no-cache, must-revalidate");
			return View::make('user.update',[
				'user' => $user,
				'errors' => $validator->errors()
			]);
		}
	}
}
