<?php

class Item extends \Eloquent {
	//ITB Coordinate
	const DEFAULT_LAT = -6.8914441;
	const DEFAULT_LNG = 107.6106617;
	
	const DEFAULT_RAD = 0.300; //3km

	const LOST = 'lost';
	const FOUND = 'found';

	public static function imagePath() { return public_path().'/uploads/item'; }

	public $file_image_1,$file_image_2,$file_image_3;

	protected $fillable = ['name','type','finished','contact_name','lat','lng','contact_no','category_id','description','location','user_id','image_1','image_2','image_3'];
	protected $table = 'item';

	public static $rules = [
		'name' => 'required',
		'type' => 'required',
		'contact_name' => 'required',
		'lat' => 'numeric',
		'lng' => 'numeric',
		'contact_no' => 'required',
		'category_id' => 'required',
		'location' => 'required',
		'file_image_1' => 'image',
		'file_image_2' => 'image',
		'file_image_3' => 'image',
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

	public function tags(){
		return $this->hasMany('Tag','item_id','id');
	}

	public function getImageUrl($i = 1){
		switch ($i) {
			case 1: $image_filename = $this->image_1; break;
			case 2: $image_filename = $this->image_2; break;
			case 3: $image_filename = $this->image_3; break;
			default: $image_filename = $this->image_1;
		}
		if ($image_filename === null){
			return '';
		} else {
			return asset('uploads/item/'.$image_filename);
		}
	}

	public function saveImage($i){
		switch ($i) {
			case 1: $image = $this->file_image_1; break;
			case 2: $image = $this->file_image_2; break;
			case 3: $image = $this->file_image_3; break;
			default: return false;
		}
		var_dump($image);
		//exit();
		$extension = $image->getClientOriginalExtension();
		$image->move(Item::imagePath(),$this->id."_".$i.".".$extension);
		switch ($i) {
			case 1: $this->image_1 = $this->id."_".$i.".".$extension; break;
			case 2: $this->image_2 = $this->id."_".$i.".".$extension; break;
			case 3: $this->image_3 = $this->id."_".$i.".".$extension; break;
		}
		$this->save();
	}
}