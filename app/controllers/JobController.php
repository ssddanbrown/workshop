<?php

class JobController extends \BaseController {

	protected $job;

	public function __construct(Job $job)
	{
		$this->job = $job;
	}


	public function index()
	{
		$jobs = $this->job->all();
		return View::make('jobs.index', ['jobs' => $jobs]);
	}


	public function create()
	{
		$customers = Customer::orderBy('name')->lists('name', 'id');
		return View::make('jobs.create', ['customers' => $customers]);
	}


	public function store()
	{

		$errors = null;
		$job_input = Input::only('title', 'text', 'due', 'customer_id');
		if ( !$this->job->fill($job_input)->isValid() ) {
			$errors = $this->job->errors;
		}

		$items = array();
		foreach (Input::get('items') as $input) {
			if ( empty($input['item_title']) && empty($input['item_text']) ) {
				break;
			}
			$new_item = new Item;
			if ( !$new_item->fill($input)->isValid() ){
				(!$errors) ? $errors = $new_item->errors : $errors->merge($new_item->errors->getMessages());
			}
			array_push($items, $new_item);
		}

		$costs = array();
		foreach (Input::get('costs') as $key => $input) {
			if ( empty($input['cost_qty']) && empty($input['cost_text']) && empty($input['cost_price']) ) {
				break;
			}
			$new_cost = new Cost;
			if ( !$new_cost->fill($input)->isValid() ) {
				(!$errors) ? $errors = $new_cost->errors : $errors->merge($new_cost->errors->getMessages());
			}
			array_push($items, $new_cost);
		}

		if ($errors != null) {
			return Redirect::back()->withInput()->withErrors($errors);
		} else {
			//If everything is okay save and returtn to index page
			$this->job->save();
			foreach ($items as $item) { $this->job->items()->save($item); }
			foreach ($costs as $cost) { $this->job->costs()->save($cost); }
			return Redirect::route('jobs.index');
		}

	}


	public function show($id)
	{
		$job = $this->job->find($id);
		return View::make('jobs.show', ['job' => $job]);
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