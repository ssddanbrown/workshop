<?php

class SettingsController extends \BaseController {

	protected $setting;

	public function __construct(Setting $setting)
	{
		$this->setting = $setting;
	}

	public function index()
	{
		return View::make('settings.index');
	}


}