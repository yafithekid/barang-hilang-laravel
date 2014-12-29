<?php

class Comment extends \Eloquent {
	public static $rules = [
		'user_id' => 'required | exists:user,id',
		'item_id' => 'required | exists:item,id',
		'content' => 'required',
	];
	protected $fillable = ['user_id','content','item_id'];

	public $timestamps = false;
	protected $table = 'comment';

	public function user(){
		return $this->belongsTo('User','user_id','id');
	}

	public function item(){
		return $this->belongsTo('Item','item_id','id');
	}
}