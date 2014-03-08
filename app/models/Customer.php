<?php


class Customer extends Eloquent {

	protected $table = 'customers';

	protected $fillable = ['first_name', 'last_name', 'email', 'phone'];

	public static $rules = [
		'last_name' => 'required'
	];

	public $errors;

	public function jobs()
	{
		return $this->hasMany('Job');
	}

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