<?php


class Job extends Eloquent {

	protected $table = 'jobs';

	protected $fillable = ['title', 'text', 'finished', 'due', 'customer', 'items', 'costs'];

	public static $rules = [
		'title' => 'required'
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