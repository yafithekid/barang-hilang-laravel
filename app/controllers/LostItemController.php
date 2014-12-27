<?php

class LostItemController extends \BaseController {
	
	public function getIndex(){
		return View::make('lost.index');
	}

	public function getCreate(){
		return View::make('lost-item.create')->nest('_form','lost-item._form',['lost_item' => new LostItem()]);
	}

	public function postCreate(){
		$validation = Validator::make(Input::all(),Lost::$rules);
		if ($validation->fails()){
			return Redirect::back()->withInput();
		} else {
			$lost_item = new LostItem(Input::all());
			return Redirect::action('LostController@getIndex');
		}
	}
}