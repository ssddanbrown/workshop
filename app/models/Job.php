<?php


class Job extends Eloquent {

	protected $table = 'jobs';

	protected $fillable = ['title', 'text', 'finished', 'due', 'customer', 'items', 'costs'];

	public static $rules = [
		'title' => 'required'
	];

	public $errors;


	public function getItemsAttribute()
	{
		return json_decode($this->attributes['items']);
	}
	public function setItemsAttribute($value)
	{
		$this->attributes['items'] = json_encode($value);
	}
	public function getCostsAttribute()
	{
		return json_decode($this->attributes['costs']);
	}
	public function setCostsAttribute($value)
	{
		$this->attributes['costs'] = json_encode($value);
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