<?php

class LoginController extends \BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		if (Auth::check()) {
			return Redirect::route('jobs.index');
		}

		return View::make('login.index');
	}

	public function attempt()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if (Auth::attempt(array('username' => $username, 'password' => $password), true)) {
			 return Redirect::intended('login');
		}

		return Redirect::back()->withInput()->withErrors(array('password' => 'Username and password combination does not exist'));
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('login.index');
	}

}