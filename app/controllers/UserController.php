<?php

class UserController extends \BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->all();
		return View::make('settings.users.index', ['users' => $users]);
	}

	public function show($id)
	{
		$this->user = $this->user->find($id);
		return View::make('settings.users.show', ['user' => $this->user]);
	}

	public function create()
	{
		return View::make('settings.users.create');
	}

	public function store()
	{
		$input = Input::all();

		if ( Input::get('password') != Input::get('password_check') ) {
			return Redirect::back()->withInput()->withErrors(array('password_check' => 'Passwords are not the same'));
		} elseif ( ctype_space(Input::get('password')) || Input::get('password') == '' ) {
			return Redirect::back()->withInput()->withErrors(array('password' => 'Password cannot contain spaces or be blank'));
		}
		
		$this->user->password =  Hash::make(Input::get('password'));

		if ( !$this->user->fill($input)->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}

		$this->user->save();
		return Redirect::route('settings.users');
	}

	public function edit($id)
	{
		$this->user = $this->user->find($id);
		return View::make('settings.users.edit', ['user' => $this->user]);
	}

	public function update($id)
	{
		$this->user = $this->user->find($id);

		$password = Input::get('password');
		if ( $password != '') {
			if ( $password != Input::get('password_check') ) {
				return Redirect::back()->withInput()->withErrors(array('password_check' => 'Passwords are not the same'));
			} elseif ( ctype_space($password) ) {
				return Redirect::back()->withInput()->withErrors(array('password' => 'Password cannot contain spaces'));
			}
			$this->user->password = Hash::make($password);
		}
		
		if ( !$this->user->fill(Input::all())->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}


		$this->user->save();
		return Redirect::route('settings.users.show', $this->user->id);
	}

	public function destroy($id)
	{
		$this->user = $this->user->find($id);
		$this->user->delete();
		return Redirect::route('settings.users');
	}

	public function search()
	{
		$term = Input::get('term');
		$users = $this->user->where('username', 'LIKE', '%'.$term.'%')->get();
		return Response::json($users);
	}

	public function assign()
	{
		$this->user = $this->user->find(Input::get('user'));
		$job_id = Input::get('job');

		if (!$this->user->jobs->contains($job_id)) {
			$this->user->jobs()->attach($job_id);
			return Response::json('Success', 200);	
		}

		return Response::json(array('message' => 'User already assigned'), 400);
	}

	public function unassign()
	{
		$this->user = $this->user->find(Input::get('user'));
		$this->user->jobs()->detach(Input::get('job'));
		return Response::json('Success', 200);
	}
	

}