<?php

class LostItem extends \Eloquent {
	public $image;

	//protected $fillable = [];
	protected $table = 'lost';

	public static $rules = [
		'name' => 'required',
		'owner' => 'required',
		'lost_location' => 'required',
		'lost_lat' => 'numeric',
		'lost_lng' => 'numeric',
		'image' => 'image',
		'contact_person' => 'required',
		'item_category_id' => 'required',
	];
	
}