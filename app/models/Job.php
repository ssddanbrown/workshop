<?php

class Job extends Eloquent {

	protected $fillable = ['title', 'text', 'due', 'customer_id'];

	public static $rules = [
		'title' => 'required'
	];

	public $errors;

	// Relationships
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
	public function notes()
	{
		return $this->hasMany('Note')->orderBy('created_at', 'DESC');
	}

	public function setTotal($costs = null)
	{
		if(is_null($costs)){
			$costs = $this->costs;
		}
		$total = 0;
		if (count($costs) > 0) {
			foreach($costs as $cost){
				$total += $cost->total();
			}
		}
		$this->total = $total;
		return $total;
	}

	//Validation
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