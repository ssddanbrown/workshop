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

	public function create()
	{
		return View::make('settings.users.create');
	}

	public function store()
	{
		$input = Input::all();

		if ( Input::get('password') != Input::get('password_check') ) {
			return Redirect::back()->withInput()->withErrors(array('password_check' => 'Passwords are not the same'));
		} elseif ( ctype_space(Input::get('password')) ) {
			return Redirect::back()->withInput()->withErrors(array('password' => 'Password cannot contain spaces'));
		}
		
		$this->user->password =  Hash::make(Input::get('password'));

		if ( !$this->user->fill($input)->isValid() ) {
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}

		$this->user->save();
		return Redirect::route('settings.users');
	}
	

}