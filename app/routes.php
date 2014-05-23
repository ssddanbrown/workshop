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
Route::resource('jobs', 'JobController');


// Template Routes
Route::resource('templates', 'TemplateController');


// Note Routes
Route::post('note', array(
	'uses' => 'NoteController@store',
	'as'	=> 'notes.store'
	));
Route::get('note/{notes}/edit', array(
	'uses' => 'NoteController@edit',
	'as' =>	'notes.edit'
	));
Route::put('note/{notes}', array(
	'uses' => 'NoteController@update',
	'as' => 'notes.update'
	));
Route::delete('note/{notes}', array(
	'uses' => 'NoteController@destroy',
	'as' => 'notes.destroy'
	));