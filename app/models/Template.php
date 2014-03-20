<?php

class Template extends Eloquent {

	protected $fillable = ['title', 'text', 'days', 'hours', 'mins'];

	public static $rules = [
		'title' => 'required',
		'days' => 'numeric',
		'hours' => 'numeric',
		'mins' => ['numeric', 'required_without_all:hours,days']
	];

	public $errors;

	// Relationships
	public function costs()
	{
		return $this->hasMany('Cost');
	}

	public function mergeTimes(){
		$time = 0;
		$time += $this->mins * 60;
		$time += $this->hours * 60 * 60;
		$time += $this->days * 60 * 60 * 24;
		$this->job_time = $time;
		unset($this->days, $this->hours, $this->mins );
		return $time;
	}

	//Model Events
	public static function boot()
	{
		parent::boot();
		
		//On Save Event
		Template::saving(function($template)
		{
			$total = 0;
			if ( count($template->costs) > 0 ) {
				foreach($template->costs as $cost){
					$total = $total + $cost->total();
				}
			}
			$template->total = $total;
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
	

}