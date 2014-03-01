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
		$this->job->save();

		$items_input = Input::get('items');
		foreach ($items_input as $item) {
			$new_item = new Item;
			$new_item->fill($item);
			$new_item->job_id = $this->job->id;
			$new_item->save();
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