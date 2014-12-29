<?php

class ItemController extends \BaseController {
	
	public function getIndex(){
		return View::make('item.index');
	}

	public function getSearch($q)
	{
		return View::make('item.index');
	}

	public function getCreate(){
		$lost_item = new Item();
		$lost_item->lost_lat = Item::DEFAULT_LAT;
		$lost_item->lost_lng = Item::DEFAULT_LNG;
		View::share('lost_item', $lost_item);
		View::share('item_categories', Category::all());
		return View::make('item.create');
	}

	public function postCreate(){
		$validation = Validator::make(Input::all(),Item::$rules);
		if ($validation->fails()){
			return Redirect::back()->withInput()->withErrors($validation);
		} else {
			$lost_item = new Item(Input::all());
			$lost_item->save();
			Session::flash('global-success','Barang berhasil ditambahkan');
			return Redirect::action('ItemController@getIndex');
		}
	}

	public function postComment($item_id){
		//prevent user comment as other user.
		Input::merge(['item_id' => $item_id,'user_id'=>Auth::user()->id]);
		
		$validator = Validator::make(Input::all(),Comment::$rules);
		if (!$validator->fails()){
			$comment = new Comment(Input::all());
			$comment->save();
			
		}
		return Redirect::action('ItemController@anyView',['id' => $item_id]);
	}

	public function anyView($id)
	{
		if (($item = Item::where('id','=',$id)->first()) === null){
			App::abort(404);
		} else {
			return View::make('item.view',['item'=>$item,'comments' => $item->comments]);
		}	
	}
}