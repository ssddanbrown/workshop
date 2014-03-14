<?php

class Job extends Eloquent {

	protected $fillable = ['title', 'text', 'finished', 'due', 'customer_id'];

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

	//Model Evevents
	public static function boot()
	{
		parent::boot();

		//On Save Event
		Job::saving(function($job)
		{
			$total = 0;
			if ( count($job->costs) > 0 ) {
				foreach($job->costs as $cost){
					$total = $total + $cost->total();
				}
			}
			$job->total = $total;
		});
		//End on save event

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



	public function humanTime($field)
	{
		return Format::humanTime( date_create($this->$field)->getTimestamp() );
	}
	

}