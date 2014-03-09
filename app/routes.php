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

Route::resource('customers', 'CustomerController');

Route::post('jobs/create',
	array(
	'uses'=>'JobController@customerToJob',
	'as'=>'jobs.customertojob'
	));

Route::get('jobs/create/job', array('uses' => 'JobController@createJob',
								'as'	=>	'jobs.createjob') );
Route::get('jobs/archive', array('uses' => 'JobController@archiveIndex',
									'as' => 'jobs.archive') );
Route::post('jobs/{jobs}/status', array('uses' 	=> 'JobController@toggleStatus',
										'as'	=>	'jobs.toggle') );
Route::resource('jobs', 'JobController');