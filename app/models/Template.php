<?php

class Template extends Eloquent {

	protected $fillable = ['title', 'text', 'days', 'hours', 'mins'];

	public static $rules = [
		'title' => 'required',
		'days' => 'integer',
		'hours' => 'integer',
		'mins' => ['integer', 'required_without_all:hours,days']
	];

	public $errors;

	// Relationships
	public function costs()
	{
		return $this->hasMany('Cost');
	}

	// Utilities
	public function mergeTimes()
	{
		$time = 0;
		$time += $this->mins * 60;
		$time += $this->hours * 60 * 60;
		$time += $this->days * 60 * 60 * 24;
		return $time;
	}

	public function toJob()
	{
		$job = new Job;
		$job->title = $this->title;
		$job->text = $this->text;

		$due = time() + $this->mergeTimes();
		$job->due = Format::date($due);

		$job->costs = $this->costs;
		return $job;
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