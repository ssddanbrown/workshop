<?php


class Item extends Eloquent {

	protected $fillable = ['item_title', 'item_text'];

	public static $rules = [
		'item_title' => 'required'
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