<?php

class Setting extends Eloquent {

	protected $table = 'settings';

	public $timestamps = false;

	private static $defaults = array(
		'item_name'		=>	'bike',
		'item_names'	=>	'bikes',
		'item_prop1'	=>	'Title',
		'item_prop2'	=>	'Description',
	);

	public static function get($key)
	{
		return static::$defaults[$key];
	}


}