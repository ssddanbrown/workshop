<?php

class PublicController extends \BaseController {


	public function index()
	{
		$templates = Template::getPublic();
		return View::make('public.index', ['templates' => $templates]);
	}


} 