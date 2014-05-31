<?php

class Job extends Eloquent {

	protected $fillable = ['title', 'text', 'due', 'customer_id'];

	public static $rules = [
		'title' => 'required',
		'due'   => 'date'
	];

	public $errors;

	// Accessors & Mutators
	public function setDueAttribute($due)
	{
		$this->attributes['due'] = Format::dateToDatabase($due);
	}

	// Relationships
	public function state()
	{
		return $this->belongsTo('State');
	}

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

	// State Display
	public function displayStates()
	{
		$states = State::all()->sortBy('value');
		$output = '';

		foreach( $states as $state ) {
			if ($this->state_id == $state->id) {
				$output .= '<div class="state current">'.$state->name.'</div>';
			} else {
				$output .= Form::open( array(
					'method' => 'POST',
					'route' => ['jobs.changestate', $this->id],
					'class' => 'inline'
				));
				$output .= Form::hidden('state', $state->id);
				$output .= Form::submit($state->name, ['class'=>'state']);
				$output .= Form::close();
			}
		}

		return $output;
	}
	

}