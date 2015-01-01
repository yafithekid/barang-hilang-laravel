<?php

/**
 * kelas ini belum diimplementasikan
 */
class Tag extends \Eloquent {
	public $timestamps = false;
	protected $table = 'tag';

	public function item(){
		return $this->belongsTo('Item','item_id','id');
	}
}