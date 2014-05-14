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

	public function total($return_formatted = false)
	{
		$total = ($this->cost_qty * $this->cost_price) * ((100 - $this->discount)/100);
		
		if ($return_formatted) {
			return '£'.number_format((float)$total, 2, '.', '');
		} else {
			return $total;
		} 
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

	public static function manyFromInput( $inputs, $errors)
	{
		$costs = array();
		foreach( $inputs as $input ){
			if ( !empty($input['cost_qty']) || !empty($input['cost_text']) || !empty($input['cost_price']) ) {
				$cost = new static();
				if ( !$cost->fill($input)->isValid() ) $errors->merge($cost->errors->getMessages());
				array_push($costs, $cost);
			}
		}
		return $costs;
	}

}