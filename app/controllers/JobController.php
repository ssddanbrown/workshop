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
		$input = Input::all();

		if ( !$this->job->fill($input)->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->job->errors);
		}

		$this->job->save();

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