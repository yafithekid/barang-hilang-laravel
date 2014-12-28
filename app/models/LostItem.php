<?php

class LostItem extends \Eloquent {
	const DEFAULT_LAT = -6.8914441;
	const DEFAULT_LNG = 107.6106617;
	public $image;

	protected $fillable = ['name','owner','lost_lat','lost_lng','contact_person','item_category_id','description'];
	protected $table = 'lost_item';

	public static $rules = [
		'name' => 'required',
		'owner' => 'required',
		'lost_lat' => 'numeric',
		'lost_lng' => 'numeric',
		'image' => 'image',
		'contact_person' => 'required',
		'item_category_id' => 'required',
	];
	
}