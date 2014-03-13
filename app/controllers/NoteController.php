<?php

class NoteController extends \BaseController {

	protected $note;

	public function __construct(Note $note)
	{
		$this->note = $note;
	}

	public function store()
	{
		$input = Input::all();

		$this->note->fill($input);

		if(Job::find(Input::get('job_id')) == null){
			//TODO add custom validation with error messages
			dd('cat');
		}

		$this->note->save();
		return Redirect::back();
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
		$note = $this->note->find($id);
		$note->delete();

		return Redirect::back();
	}

}