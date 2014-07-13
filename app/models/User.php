<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {


	protected $table = 'users';

	protected $fillable = ['username', 'first_name', 'last_name', 'email'];

	protected $hidden = array('password');

	public static $rules = [
		'username'	=> ['required', 'unique:users,username'],
		'first_name'	=> 'required',
		'last_name' => 'required',
		'email'		=> 'required',
		'password'	=> 'required'
	];

	public $errors;

	public function name()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}
	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
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