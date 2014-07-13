<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent {


	protected $table = 'users';

	protected $fillable = ['first_name', 'last_name', 'email'];

	protected $hidden = array('password');

	public static $rules = [
		'last_name' => 'required',
		'password'	=> 'required'
	];

	public $errors;

	public function name()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if ($validation->passes()) {
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

}