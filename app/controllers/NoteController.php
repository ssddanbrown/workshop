<?php

class NoteController extends \BaseController {

	protected $note;

	public function __construct(Note $note)
	{
		$this->note = $note;
	}

	public function store()
	{
		$input = Input::only('text', 'job_id');
		$this->note->fill($input);

		if ( Input::hasFile('media') ) {
			$file = Input::file('media');
			$original_name = $file->getClientOriginalName();
			$name = time().'-'.$original_name;
			$file = $file->move( public_path().'/uploads/', $name );
			$this->note->media = asset( 'uploads/'. $name );
			$this->note->media_name = $original_name;
		}

		if(Job::find(Input::get('job_id')) == null){
			return Redirect::back();
		}

		$this->note->save();
		return Redirect::back();
	}


	public function edit($id)
	{
		$this->note = $this->note->find($id);
		return View::make('jobs.editnote', ['note' => $this->note]);
	}


	public function update($id)
	{
		$this->note = $this->note->find($id);
		$input = Input::all();
		$this->note->fill($input);
		$this->note->save();
		return Redirect::route('jobs.show', $this->note->job_id);
	}


	public function destroy($id)
	{
		$this->note = $this->note->find($id);
		$this->note->delete();

		return Redirect::back();
	}

}