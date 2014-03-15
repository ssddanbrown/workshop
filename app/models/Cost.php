<?php

class Cost extends Eloquent {

	protected $fillable = ['cost_qty', 'cost_text', 'cost_price', 'discount'];

	public static $rules = [
		'cost_qty' => ['required', 'numeric'],
		'cost_text' => 'required',
		'cost_price' => ['numeric', 'required'],
		'discount' => ['numeric', 'between:0,100']
	];

	public $errors;

	public function total($return_formatted = false){

			return ($this->cost_qty * $this->cost_price) * ((100 - $this->discount)/100);
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