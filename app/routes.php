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
	return Redirect::to('/jobs');
});


// Customer Routes
Route::resource('customers', 'CustomerController');



// Job Routes
Route::post('jobs/create', array(
	'uses'=>'JobController@customerToJob',
	'as'=>'jobs.customertojob' ));

Route::get('jobs/create/job', array(
	'uses' => 'JobController@createJob',
	'as'	=>	'jobs.createjob') );

Route::get('jobs/{jobs}/edit/customer', array(
	'uses' =>'JobController@editCustomer',
	'as' => 'jobs.editcustomer'));
Route::put('jobs/{jobs}/edit/customer', array(
	'uses' => 'JobController@updateCustomer',
	'as' => 'jobs.update.customer'
	));

Route::get('jobs/archive', array(
	'uses' => 'JobController@archiveIndex',
	'as' => 'jobs.archive') );

Route::post('jobs/{jobs}/status', array(
	'uses' 	=> 'JobController@toggleStatus',
	'as'	=>	'jobs.toggle') );

Route::resource('jobs', 'JobController');

// Note Routes
Route::post('jobs/note', array(
	'uses' => 'NoteController@store',
	'as'	=> 'notes.store'
	));
