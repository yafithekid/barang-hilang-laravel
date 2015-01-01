<?php

class Item extends \Eloquent {
	//ITB Coordinate
	const DEFAULT_LAT = -6.8914441;
	const DEFAULT_LNG = 107.6106617;
	
	const DEFAULT_RAD = 0.300; //3km

	const LOST = 'lost';
	const FOUND = 'found';

	public static function imagePath() { return public_path().'/uploads/item'; }

	public $image;

	protected $fillable = ['name','type','finished','contact_name','lat','lng','contact_no','category_id','description','location','user_id','image_filename'];
	protected $table = 'item';

	public static $rules = [
		'name' => 'required',
		'type' => 'required',
		'contact_name' => 'required',
		'lat' => 'numeric',
		'lng' => 'numeric',
		'image' => 'image',
		'contact_no' => 'required',
		'category_id' => 'required',
		'location' => 'required',
	];
	
	public function user(){
		return $this->belongsTo('User','user_id','id');
	}

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