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
		return View::make('jobs.create');
	}


	public function store()
	{

		$job_input = Input::only('title', 'text', 'due');
		if ( !$this->job->fill($job_input)->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->job->errors);
		}

		$items_input = Input::get('items');
		$items = array();
		foreach ($items_input as $input) {
			if ( empty($input['item_title']) && empty($input['item_text']) ) {
				break;
			}
			$new_item = new Item;
			if ( !$new_item->fill($input)->isValid() ){
				return Redirect::back()->withInput()->withErrors($new_item->errors);
			}
			array_push($items, $new_item);
		}

		$costs_input = Input::get('costs');
		$costs = array();
		foreach ($costs_input as $input) {
			if ( empty($input['cost_qty']) && empty($input['cost_text']) && empty($input['cost_price']) ) {
				break;
			}
			$new_cost = new Cost;
			if ( !$new_cost->fill($input)->isValid() ) {
				return Redirect::back()->withInput()->withErrors($new_cost->errors);
			}
			array_push($costs, $new_cost);
		}

		//If everything is okay save and returtn to index page
		$this->job->save();
		foreach ($items as $item) {
			$item->job_id = $this->job->id;
			$item->save();
		}
		foreach ($costs as $cost) {
			$cost->job_id = $this->job->id;
			$cost->save();
		}

		return Redirect::route('jobs.index');
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