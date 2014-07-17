<?php

Route::get('/test', function()
{
	return View::make('common.test');
});

// User Login/Logout
Route::get('/login', array(
	'uses'	=> 'LoginController@index',
	'as'	=> 'login.index'
	));
Route::post('/login', array(
	'uses'	=> 'LoginController@attempt',
	'as'	=> 'login.attempt'
	));
Route::get('/logout', array(
	'uses'	=> 'LoginController@logout',
	'as'	=> 'login.logout'
	));


Route::group(array('before' => 'auth'), function()
{
	// Customer Routes
	Route::get('customers/search', array(
		'uses' => 'CustomerController@search',
		'as' => 'customers.search'
		));
	Route::resource('customers', 'CustomerController');

	// Job Routes
	Route::get('jobs/create/template/{templates}', array(
		'uses' => 'JobController@createFromTemplate',
		'as' =>	'jobs.createfromtemplate'
		));
	Route::post('jobs/status/{job}', array(
		'uses' => 'JobController@changeState',
		'as' => 'jobs.changestate'
	));
	Route::resource('jobs', 'JobController');


	// Template Routes
	Route::resource('templates', 'TemplateController');


	// Note Routes
	Route::group(array('prefix' => 'note'), function()
	{
		Route::post('/', array(
			'uses' => 'NoteController@store',
			'as'	=> 'notes.store'
		));
		Route::get('{notes}/edit', array(
			'uses' => 'NoteController@edit',
			'as' =>	'notes.edit'
		));
		Route::put('{notes}', array(
			'uses' => 'NoteController@update',
			'as' => 'notes.update'
		));
		Route::delete('{notes}', array(
			'uses' => 'NoteController@destroy',
			'as' => 'notes.destroy'
		));
	});

	Route::get('settings', array(
		'uses'	=> 'SettingsController@index',
		'as'	=> 'settings.index'
		));
	Route::get('settings/states', array(
		'uses'	=> 'StateController@edit',
		'as'	=> 'settings.states'
		));
	Route::post('settings/states', array(
		'uses'	=> 'StateController@save',
		'as'	=> 'settings.states.save'
		));
	Route::delete('settings/states/{id}', array(
		'uses' 	=> 'StateController@delete',
		'as'	=> 'settings.states.delete'
		));
	Route::get('settings/states/{id}', array(
		'uses'	=> 'StateController@deleteConfirmation',
		'as'	=> 'settings.states.delete.confirmation'
		));
	Route::get('settings/users', array(
		'uses' => 'UserController@index',
		'as'   => 'settings.users'
		));
	Route::get('settings/users/show/{id}', array(
		'uses'	=> 'UserController@show',
		'as'	=> 'settings.users.show'
		));
	Route::get('settings/users/create', array(
		'uses' => 'UserController@create',
		'as'	=> 'settings.users.create'
		));
	Route::post('settings/users/create', array(
		'uses'	=> 'UserController@store',
		'as'	=> 'settings.users.store'
		));
	Route::get('settings/users/edit/{id}', array(
		'uses'	=> 'UserController@edit',
		'as'	=> 'settings.users.edit'
		));
	Route::put('settings/users/{id}', array(
		'uses'	=> 'UserController@update',
		'as'	=> 'settings.users.update'
		));
	Route::delete('settings/users/{id}', array(
		'uses'	=> 'UserController@destroy',
		'as'	=> 'settings.users.destroy'
		));
	Route::get('users/search', array(
		'uses' 	=> 'UserController@search',
		'as' 	=> 'users.search'
		));
	Route::post('users/assign', array(
		'uses'	=> 'UserController@assign',
		'as'	=> 'users.assign'
		));
	Route::post('users/unassign', array(
		'uses'	=> 'UserController@unassign',
		'as'	=>	'users.unassign'
		));
});
