<?php

class State extends Eloquent {

	protected $fillable = ['name'];

	public $timestamps = false;

	public static $rules = [
		'name' => 'required',
		'value' => ['unique:states,value', 'integer']
	];

	public $errors;

	public static function getInitialState()
	{
		$state = static::all()->sortBy('value')->first();
		return $state->id;
	}

	/**
	 * getCompleteState Get the last state that represent completion
	 * @return int state id
	 */
	public static function getCompleteState()
	{
		return Cache::rememberForever('completeState', function()
		{
			$state = static::all()->sortBy('value')->last();
			return $state->id;
		});
	}

	public static function byValue()
	{
		return Cache::rememberForever('statesByValue', function()
		{
			return static::all()->sortBy('value');
		});
	}

	// Relationships
	public function jobs()
	{
		return $this->hasMany('Job');
	}

	public function jobCount()
	{
		return count($this->jobs);
	}

	// Validation
	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if ($validation->passes()) {
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

	// Cache
	public static function clearCache()
	{
		Cache::forget('completeState');
		Cache::forget('statesByValue');
	}


}