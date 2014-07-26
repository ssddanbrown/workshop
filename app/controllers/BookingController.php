<?php

class BookingController extends \BaseController {

	protected $job;

	public function __construct(Job $job)
	{
		$this->job = $job;
	}

	public function create($template_id)
	{
		$template = Template::find($template_id);
		return View::make('public.book', ['template'=>$template]);
	}

	public function store()
	{
		// // Create job from template
		// $template = Template::find(Input::get('template_id'));
		// $this->job = $template->toJob();

		// // Create customer from input and save
		// $customer = new Customer();
		// if ( !$customer->fill(Input::all())->isValid() ) {
		// 	return Redirect::back()->withInput()->withErrors($customer->errors);
		// }

		// $this->job->save();
		// $this->job->costs()->saveMany($costs);
		// $this->job->customer()->save($customer);

		// if (Input::has('time')) {
		// 	$text = 'Customer has requested this job for ' . Input::get('time');
		// 	$note = Note::create(array('text' => $text));
		// 	$this->job->notes->save($note);
		// }
		// return 'New Request Saved';
	}


}