<?php


class Job extends Eloquent {

	protected $fillable = ['title', 'text', 'finished', 'due', 'customer_id'];

	public static $rules = [
		'title' => 'required'
	];

	public $errors;

	public function customer()
	{
		return $this->belongsTo('Customer');
	}
	public function items()
	{
		return $this->hasMany('Item');
	}
	public function costs()
	{
		return $this->hasMany('Cost');
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