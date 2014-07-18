<?php

use Illuminate\Support\MessageBag;

class JobController extends \BaseController {

	protected $job;

	public function __construct(Job $job)
	{
		$this->job = $job;
	}


	public function index()
	{
		$order = (Input::has('order')) ? Input::get('order') : 'title';
		// todo: Add sort order (ASC/DESC)
		$jobs = $this->job->orderBy($order)->get();
		return View::make('jobs.index', ['jobs' => $jobs]);
	}


	public function create()
	{
		return View::make('jobs.create');
	}


	public function createFromTemplate( $id )
	{
		$template = Template::find( $id );
		$this->job = $template->toJob();
		return View::make('jobs.createfromtemplate', ['job' => $this->job, 'template' => $template]);
	}


	public function store()
	{
		$errors = new MessageBag;
		$job_input = Input::only('title', 'text', 'due', 'customer_id');

		if ( !$this->job->fill($job_input)->isValid() ) {
			$errors = $this->job->errors;
		}
		// Check if customer is set in database
		if( Customer::find($this->job->customer_id) == null ){
			$this->job->customer_id = 0;
		}
		// Create Items and Costs, get any errors
		$items = Item::manyFromInput( Input::get('items'), $errors );
		$costs = Cost::manyFromInput( Input::get('costs'), $errors );

		if ( $errors->count() > 0 ) {
			return Redirect::back()->withInput()->withErrors($errors);
		} else {
			// Save Job and relations if no errors
			$this->job->state_id = State::getInitialState();
			$this->job->setTotal($costs);
			$this->job->save();
			$this->job->items()->saveMany($items);
			$this->job->costs()->saveMany($costs);
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
		$job = $this->job->find($id);
		$customer = $job->customer;
		return View::make('jobs.edit', ['job' => $job, 'customer' => $customer]);
	}


	public function update($id)
	{
		$this->job = $this->job->find($id);
		$errors = new MessageBag;

		$job_input = Input::only('title', 'text', 'due', 'customer_id');
		if ( !$this->job->fill($job_input)->isValid() ) {
			$errors = $this->job->errors;
		}
		// Create Items and Costs while checking for errors
		$items = Item::manyFromInput( Input::get('items'), $errors );
		$costs = Cost::manyFromInput( Input::get('costs'), $errors );

		if ( $errors->count() > 0 ) {
			return Redirect::back()->withInput()->withErrors($errors);
		} else {
			// Delete old relations and add current ones
			$this->job->items()->delete();
			$this->job->costs()->delete();
			$this->job->items()->saveMany($items);
			$this->job->costs()->saveMany($costs);
			// Set total and save Job
			$this->job->setTotal();
			$this->job->save();
			// Redirect back to Job
			return Redirect::route('jobs.show', $this->job->id);
		}

	}

	public function destroy($id)
	{
		$this->job = $this->job->find($id);
		$this->job->items()->delete();
		$this->job->costs()->delete();
		$this->job->notes()->delete();
		$this->job->delete();

		return Redirect::route('jobs.index');
	}

	public function changeState($id)
	{
		$this->job = $this->job->find($id);
		$state = Input::get('state');
		$this->job->state_id = $state;

		if( $this->job->state != null ) {
			$this->job->save();
		}

		return Redirect::back();
	}


}