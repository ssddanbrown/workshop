<?php

class JobController extends \BaseController {

	protected $job;

	public function __construct(Job $job)
	{
		$this->job = $job;
	}


	public function index()
	{
		$jobs = $this->job->whereFinished(false)->get();
		return View::make('jobs.index', ['jobs' => $jobs]);
	}

	public function archiveIndex()
	{
		$jobs = $this->job->whereFinished(true)->get();
		return View::make('jobs.archive', ['jobs' => $jobs]);
	}


	public function create()
	{
		$customers = $this->customerList();
		return View::make('jobs.create-customer', ['customers' => $customers]);
	}
	public function customerToJob()
	{
		Input::flashOnly('customer_id');
		return Redirect::route('jobs.createjob');
	}
	public function createJob()
	{
		Session::reflash(Input::old('customer_id'));
		return View::make('jobs.create');
	}


	public function store()
	{

		$errors = null;
		$job_input = Input::only('title', 'text', 'due', 'customer_id');

		if ( !$this->job->fill($job_input)->isValid() ) {
			$errors = $this->job->errors;
		}

		if( Customer::find($this->job->customer_id) == null ){
			$this->job->customer_id = 0;
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
		$job = $this->job->find($id);
		$customers = $this->customerList();
		return View::make('jobs.edit', ['job' => $job, 'customers' => $customers]);
	}


	public function update($id)
	{
		$this->job = $this->job->find($id);
		$errors = null;
		$job_input = Input::only('title', 'text', 'due', 'customer_id');
		if ( !$this->job->fill($job_input)->isValid() ) {
			$errors = $this->job->errors;
		}

		$items = array();
		$items_delete = array();
		foreach (Input::get('items') as $key => $input) {
			if ( empty($input['item_title']) && empty($input['item_text']) ) {
				$item = Item::find($key);
				if ($item != null) {
					array_push($items_delete, $item);
				}
				break;
			}
			$new_item = new Item;
			if(Item::find($key) != null) $new_item = Item::find($key);
			if ( !$new_item->fill($input)->isValid() ){
				(!$errors) ? $errors = $new_item->errors : $errors->merge($new_item->errors->getMessages());
			}
			array_push($items, $new_item);
		}

		$costs = array();
		$costs_delete = array();
		foreach (Input::get('costs') as $key => $input) {
			if ( empty($input['cost_qty']) && empty($input['cost_text']) && empty($input['cost_price']) ) {
				$cost = Cost::find($key);
				if ($cost != null) {
					array_push($costs_delete, $cost);
				}
				break;
			}
			$new_cost = new Cost;
			if (Cost::find($key) != null) $new_cost = Cost::find($key);
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
			foreach ($items_delete as $item) { $item->delete(); }
			foreach ($costs as $cost) { $this->job->costs()->save($cost); }
			foreach ($costs_delete as $cost) { $cost->delete(); }
			return Redirect::route('jobs.show', $this->job->id);
		}

	}


	public function destroy($id)
	{
		$job = $this->job->find($id);
		$job->items()->delete();
		$job->costs()->delete();
		$job->delete();

		return Redirect::route('jobs.index');
	}

	public function toggleStatus($id)
	{
		$job = $this->job->find($id);
		if( $job->finished == false){
			$job->finished = true;
		} else {
			$job->finished = false;
		}
		$job->save();

		return Redirect::back();
	}

	private function customerList()
	{
		return Customer::orderBy('last_name')->paginate(5);
	}

}