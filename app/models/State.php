<?php

class State extends Eloquent {

	/**
	 * States always have one with value 0 and one with value 12.
	 * With 0 being the earliest state and 12 being the latest (Complete).
	 * All other state's values should be integers between these values.
	 */

	protected $fillable = ['name'];

	public $timestamps = false;

	public static $rules = [
		'name' => 'required',
		'value' => ['unique:states,value', 'integer', 'between:0,12']
	];

	public $errors;

	// Relationships
	public function jobs()
	{
		return $this->hasMany('Job');
	}

	// Validation
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