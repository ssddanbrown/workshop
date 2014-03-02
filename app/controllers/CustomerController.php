<?php

class CustomerController extends \BaseController {

	protected $customer;

	public function __construct(Customer $customer)
	{
		$this->customer = $customer;
	}


	public function index()
	{
		$customers = $this->customer->all();
		return View::make('customer.index', ['customers' => $customers]);
	}


	public function create()
	{
		return View::make('customer.create');
	}


	public function store()
	{
		$input = Input::all();
		
		if ( !$this->customer->fill($input)->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->customer->errors);
		}
		
		$this->customer->save();

		return Redirect::route('customers.index');
	}

	public function show($id)
	{
		$customer = $this->customer->find($id);

		return View::make('customer.show', ['customer' => $customer]);
	}

	public function edit($id)
	{
		$customer = $this->customer->find($id);

		return View::make('customer.edit', ['customer' => $customer]);
	}


	public function update($id)
	{
		$input = Input::all();
		$this->customer = $this->customer->find($id);
		if ( !$this->customer->fill($input)->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->customer->errors);
		}
		
		$this->customer->save();
		return Redirect::route('customers.show', $id);
	}

	public function destroy($id)
	{
		$customer = $this->customer->find($id);
		$customer->delete();

		return Redirect::to('/customers');
	}

}