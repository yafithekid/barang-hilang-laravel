<?php

class Item extends \Eloquent {

	const DEFAULT_LAT = -6.8914441;
	const DEFAULT_LNG = 107.6106617;

	const LOST = 'lost';
	const FOUND = 'found';

	public static function imagePath() { return public_path().'/uploads/item'; }

	public $image;

	protected $fillable = ['name','owner','lat','lng','contact_person','category_id','description','location'];
	protected $table = 'item';

	public static $rules = [
		'name' => 'required',
		'type' => 'required',
		'owner' => 'required',
		'lat' => 'numeric',
		'lng' => 'numeric',
		'image' => 'image',
		'contact_person' => 'required',
		'category_id' => 'required',
		'location' => 'required',
	];
	
	public function category()
	{
		return $this->hasOne('Category','category_id','id');
	}

	public function comments()
	{
		return $this->hasMany('Comment','item_id','id');
	}

	public function getImageUrl(){
		if ($this->image_filename === null){
			return '';
		} else {
			return asset('uploads/item/'.$this->image_filename);
		}
	}
}