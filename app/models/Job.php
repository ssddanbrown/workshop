<?php


class Job extends Eloquent {

	protected $fillable = ['title', 'text', 'finished', 'due', 'customer'];

	public static $rules = [
		'title' => 'required'
	];

	public $errors;

	public function items()
	{
		return $this->hasMany('Item');
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