<?php

class ItemController extends \BaseController {
	
	/**
	 * just for say hello
	 */
	public function anyIndex(){
		$lost_items = Item::where('type','=',Item::LOST)->paginate(12);
		$found_items = Item::where('type','=',Item::FOUND)->paginate(12);
		return View::make('item.index',['lost_items'=>$lost_items,'found_items'=>$found_items]);
	}
	/**
	 * paginate item based on category
	 * only to show items
	 * @var $category_id id of category
	 */
	public function anyCategory($category_id){
		$lost_items = Item::where('category_id','=',$category_id)->where('type','=',Item::LOST)->paginate(1);
		$found_items = Item::where('category_id','=', $category_id)->where('type','=',Item::FOUND)->paginate(1);
		return View::make('item.index',['lost_items'=>$lost_items,'found_items'=>$found_items]);
	}

	/**
	 * search any item with the given query string
	 * @var $q query string
	 */
	public function anySearch()
	{
		$q = Input::get('q');
		$lost_items = Item::where('name','LIKE',"%$q%")->where('type','=',Item::LOST)->paginate(12);
		$found_items = Item::where('name','LIKE',"%$q%")->where('type','=',Item::FOUND)->paginate(12);
		return View::make('item.index',['lost_items'=>$lost_items,'found_items'=>$found_items]);
	}

	public function getCreate(){
		$lost_item = new Item();
		$lost_item->lat = Item::DEFAULT_LAT;
		$lost_item->lng = Item::DEFAULT_LNG;
		View::share('lost_item', $lost_item);
		View::share('item_categories', Category::all());
		return View::make('item.create');
	}

	public function postCreate(){
		$validation = Validator::make(Input::all(),Item::$rules);
		if ($validation->fails()){
			return Redirect::back()->withInput()->withErrors($validation);
		} else {
			$item = new Item(Input::all());		
			$item->save();
			if (Input::hasFile('image')){
				$image = Input::file('image');
				$extension = $image->getClientOriginalExtension();
				$image->move(Item::imagePath(),"$item->id.".$extension);
				$item->image_filename = "$item->id.$extension";
				$item->save();
			}	
			Session::flash('global-success','Barang berhasil ditambahkan');
			return Redirect::action('ItemController@anyIndex');
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