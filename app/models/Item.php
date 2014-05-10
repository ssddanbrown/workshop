<?php


class Item extends Eloquent {

	protected $fillable = ['item_title', 'item_text'];

	public static $rules = [
		'item_title' => 'required'
	];
	
	public $errors;

	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if ($validation->passes()) {
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

	public static function manyFromInput( $inputs, $errors )
	{
		$items = array();
		foreach( $inputs as $input ){
			if ( !empty($input['item_title']) || !empty($input['item_text']) ) {
				$item = new static();
				if( !$item->fill($input)->isValid() ) $errors->merge( $item->errors->getMessages());
				array_push($items, $item);
			}
		}
		return $items;
	}



}