<?php

class Cost extends Eloquent {

	protected $fillable = ['cost_qty', 'cost_text', 'cost_price'];

	public static $rules = [
		'cost_qty' => ['required', 'integer'],
		'cost_text' => 'required',
		'cost_price' => ['numeric', 'required']
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