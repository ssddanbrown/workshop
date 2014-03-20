<?php

class TemplateController extends \BaseController {

	protected $template;

	public function __construct(Template $template)
	{
		$this->template = $template;
	}


	public function index()
	{
		$templates = $this->template->all();
		return View::make('templates.index', ['templates' => $templates]);
	}


	public function create()
	{
		return View::make('templates.create');
	}


	public function store()
	{
		$errors = null;

		$template_input = Input::only('title', 'text', 'days', 'hours', 'mins');

		if( !$this->template->fill($template_input)->isValid() ){
			$errors = $this->template->errors;
			$this->template->failed = 'GONE WRONG';
		}
		
		$this->template->mergeTimes();

		$costs = array();
		foreach (Input::get('costs') as $key => $input) {
			if ( empty($input['cost_qty']) && empty($input['cost_text']) && empty($input['cost_price']) ) {
				break;
			}
			$new_cost = new Cost;
			if ( !$new_cost->fill($input)->isValid() ) {
				(!$errors) ? $errors = $new_cost->errors : $errors->merge($new_cost->errors->getMessages());
			}
			array_push($costs, $new_cost);
		}

		if ($errors != null) {
			return Redirect::back()->withInput()->withErrors($errors);
		} else {
			//If everything is okay save and return to index page
			$this->template->setTotal($costs);
			$this->template->save();
			foreach ($costs as $cost) { $this->template->costs()->save($cost); }
			return Redirect::route('templates.index');
		}
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