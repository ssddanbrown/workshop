<?php

class TemplateController extends \BaseController {


	public function index()
	{
		$templates = Template::all();
		return View::make('templates.index', ['templates' => $templates]);
	}


	public function create()
	{
		return View::make('templates.create');
	}


	public function store()
	{
		//
	}


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}

}