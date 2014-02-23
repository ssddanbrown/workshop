<?php


class Customer extends Eloquent {

	protected $table = 'customers';

	protected $fillable = ['name', 'email', 'phone'];

	public static $rules = [
		'name' => 'required'
	];

	public $errors;


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