<?php

use Illuminate\Support\MessageBag;

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
		$errors = new MessageBag;
		$template_input = Input::only('title', 'text', 'days', 'hours', 'mins');

		if( !$this->template->fill($template_input)->isValid() ){
			$errors = $this->template->errors;
		}

		$costs = Cost::manyFromInput( Input::get('costs'), $errors );

		if ( $errors->count() > 0 ) {
			return Redirect::back()->withInput()->withErrors($errors);
		} else {
			// Save Template and Costs is no errors
			$this->template->setTotal($costs);
			$this->template->save();
			$this->template->costs()->saveMany($costs);
			return Redirect::route('templates.index');
		}
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$template = $this->template->find($id);
		return View::make('templates.edit', ['template' => $template]);
	}


	public function update($id)
	{
		$this->template = $this->template->find($id);
		$errors = new MessageBag;
		$template_input = Input::only('title', 'text', 'days', 'hours', 'mins');

		if ( !$this->template->fill($template_input)->isValid() ) {
			$errors = $this->template->errors;
		}

		$costs = Cost::manyFromInput( Input::get('costs'), $errors );

		if ( $errors->count() > 0 ) {
			return Redirect::back()->withInput()->withErrors($errors);
		} else {
			$this->template->costs()->delete();
			$this->template->costs()->saveMany($costs);
			$this->template->setTotal();
			$this->template->save();
			return Redirect::route('templates.index');
		}
	}


	public function destroy($id)
	{
		$this->template = $this->template->find( $id );
		$this->template->costs()->delete();
		$this->template->delete();

		return Redirect::route('templates.index');
	}

}