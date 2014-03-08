@extends('common.main')

@section('content')
	
	{{ Form::model( $job, array( 'method' => 'PUT', 'route' => array('jobs.update', $job->id) ) ) }}

		<div class="row-12 header">
			<h1>Edit Job</h1>
			<div class="buttons">
				{{ Form::submit('Save Job', array('class'=>'button') ) }}
			</div>
		</div>

		@include('jobs.parts.jobform')
		

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

@stop