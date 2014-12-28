<?php

class LostItemController extends \BaseController {
	
	public function getIndex(){
		return View::make('lost-item.index');
	}

	public function getSearch($q)
	{
		return View::make('lost-item.index');
	}

	public function getCreate(){
		$lost_item = new LostItem();
		$lost_item->lost_lat = LostItem::DEFAULT_LAT;
		$lost_item->lost_lng = LostItem::DEFAULT_LNG;
		View::share('lost_item', $lost_item);
		View::share('item_categories', ItemCategory::all());
		return View::make('lost-item.create');
	}

	public function postCreate(){
		$validation = Validator::make(Input::all(),LostItem::$rules);
		if ($validation->fails()){
			return Redirect::back()->withInput()->withErrors($validation);
		} else {
			$lost_item = new LostItem(Input::all());
			$lost_item->save();
			return Redirect::action('LostItemController@getIndex');
		}
	}
}