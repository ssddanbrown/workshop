<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('common.test');
});


// Customer Routes
Route::resource('customers', 'CustomerController');
Route::post('customers/search', array(
	'uses' => 'CustomerController@search',
	'as' => 'customers.search'
	));


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

