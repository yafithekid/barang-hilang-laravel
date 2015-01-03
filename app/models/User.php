<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	public $repeat_password,$image;

	public static $rules = [
		'username' => 'required | unique:user',
		'password' => 'required | id',
		'fullname' => 'required',
		'email' => 'required | email',
		'repeat_password' => 'same:password|required'
	];

	public static $update_rules = [
		'fullname' => 'required',
		'email' => 'required | email',
	];
	use UserTrait, RemindableTrait;

	protected $fillable = ['username','password','email','fullname'];

	public static function imagePath(){ return public_path().'/uploads/user'; }
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function getImageUrl(){
		if ($this->image_filename === null){
			return '';
		} else {
			return asset('uploads/user/'.$this->image_filename);
		}
	}
}
