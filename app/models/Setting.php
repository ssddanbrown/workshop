<?php

class Setting extends Eloquent {

	protected $table = 'settings';

	public $timestamps = false;

	private static $defaults = array(
		'item_name'		=>	'Item',
		'item_names'	=>	'Items',
		'item_prop1'	=>	'Title',
		'item_prop2'	=>	'Description',
	);

	public static function get($key)
	{
		return static::$defaults[$key];
	}


}