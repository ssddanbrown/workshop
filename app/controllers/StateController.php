<?php

class StateController extends \BaseController {

	protected $state;

	public function __construct(State $state)
	{
		$this->state = $state;
	}


	public function edit()
	{
		$states = State::all()->sortBy('value');
		return View::make('settings.states.index', ['states' => $states]);
	}

	public function save()
	{
		$statesInput = Input::get('state');
		foreach ($statesInput as $input) {
			if(!is_null(State::find($input['id']))) {
				$state = State::find($input['id']);
			} else {
				$state = new State();
			}
			$state->name = $input['name'];
			$state->value = $input['value'];
			$state->save();
		}
		return Redirect::route('settings.index');
	}

	public function deleteConfirmation($id)
	{
		$state = State::find($id);

		if ($state->jobCount() == 0) {
			$state->delete();
			return Redirect::back();
		}

		$states = State::where('id', '<>', $id)->lists('name', 'id');
		return View::make('settings.states.delete', ['state'=>$state, 'states'=>$states]);
	}

	public function delete($id)
	{
		$state = State::find($id);
		$transferId = Input::get('newid');

		foreach ($state->jobs as $job) {
			$job->state_id = $transferId;
			$job->save();
		}

		$state->delete();
		return Redirect::route('settings.states');
	}

}