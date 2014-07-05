<?php

class Setting extends Eloquent {

	protected $table = 'settings';

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